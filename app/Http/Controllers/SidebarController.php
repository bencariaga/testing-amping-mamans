<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Application;
use App\Models\Client;
use App\Models\EmergencyContact;
use App\Models\HouseholdMember;

class SidebarController extends Controller
{
    public function showNotifications()
    {
        return view('administrator.sidebar.notifications');
    }

    public function showUserList(Request $request)
    {
        $q    = $request->input('search');
        $per  = $request->input('per_page', 10);
        $sort = $request->input('sort_by', 'username_asc');

        $query = User::query()->when($q, fn($qb) => $qb->search($q));

        match ($sort) {
            'username_desc' => $query->orderBy('username', 'desc'),
            'role_asc'      => $query->orderBy('role', 'asc'),
            'latest'        => $query->orderBy('time_registered', 'desc'),
            'oldest'        => $query->orderBy('time_registered', 'asc'),
            default         => $query->orderBy('username', 'asc'),
        };

        if ($per === 'all') {
            $users = $query->get();
        } else {
            $users = $query->paginate($per)->appends($request->except('page'));
        }

        return view('administrator.sidebar.user-list', compact('users'));
    }

    public function showTariffLists(Request $r)
    {
        $dir = $r->input('sort', 'range_lowest');

        $services = Service::orderBy('med_assist_type', 'asc')
                           ->orderBy('exp_range_min', $dir === 'range_highest' ? 'desc' : 'asc')
                           ->get()
                           ->groupBy('med_assist_type');

        return view('administrator.sidebar.tariff-lists', [
            'serviceLists' => $services,
        ]);
    }

    public function updateTariffLists(Request $r)
    {
        foreach ($r->input('tariff_amount', []) as $serviceId => $amt) {
            $clean = str_replace(',', '', $amt);
            Service::where('service_id', $serviceId)
                ->update(['assist_amt' => $clean]);
        }

        return redirect()->route('tariff-lists')->with('success', 'Service tariff data updated.');
    }

    public function showClientList(Request $request)
    {
        $q     = $request->input('search');
        $per   = $request->input('per_page', 10);
        $sort  = $request->input('sort_by', 'name_asc');
        $query = Client::query()->search($q);

        if ($request->filled(['start_year','start_month','start_day','end_year','end_month','end_day'])) {
            $start = "{$request->start_year}-{$request->start_month}-{$request->start_day}";
            $end   = "{$request->end_year}-{$request->end_month}-{$request->end_day}";
            $query->whereHas('applications', function($q2) use($start,$end){
                $q2->whereBetween('app_date', [$start,$end]);
            });
        }

        match($sort) {
            'latest'   => $query->orderBy('time_registered','desc'),
            'oldest'   => $query->orderBy('time_registered','asc'),
            default    => $query->orderBy('surname','asc'),
        };

        if ($per === 'all') {
            $clients = $query->get();
        } else {
            $clients = $query->paginate($per)->appends($request->except('page'));
        }

        return view('administrator.sidebar.client-list', compact('clients'));
    }

    public function showAppFormInput()
    {
        $controlNo     = 'CN-' . date('Ymd-His');
        $applicationNo = 'APP-' . date('Ymd-His');

        return view('administrator.sidebar.client-registration.create', compact('controlNo', 'applicationNo'));
    }

    public function storeClientApplication(Request $request)
    {
        $data = $request->validate([
            'surname'                       => 'required|string|max:255',
            'given_name'                    => 'required|string|max:255',
            'middle_name'                   => 'nullable|string|max:255',
            'gender'                        => 'required|in:Male,Female,Prefer not to say',
            'birthdate'                     => 'required|date',
            'age'                           => 'required|integer|min:0',
            'contact_number'                => 'required|string|max:20',
            'civil_status'                  => 'required|string|max:255',
            'job_status'                    => 'required|string|max:255',
            'province'                      => 'required|string|max:255',
            'city'                          => 'required|string|max:255',
            'barangay'                      => 'required|string|max:255',
            'street'                        => 'nullable|string|max:255',
            'occupation'                    => 'nullable|string|max:255',
            'monthly_income'                => 'nullable|numeric|min:0',
            'housing_status'                => 'required|string|max:255',
            'lot_status'                    => 'required|string|max:255',
            'phicAffiliation'               => 'required|in:Unaffiliated,Affiliated',
            'phicCategory'                  => 'nullable|required_if:phicAffiliation,Affiliated|string|max:255',
            'emergency_contacts'            => 'nullable|array',
            'emergency_contacts.*.surname'              => 'required|string|max:255',
            'emergency_contacts.*.given_name'           => 'required|string|max:255',
            'emergency_contacts.*.middle_name'          => 'nullable|string|max:255',
            'emergency_contacts.*.gender'               => 'required|in:Male,Female,Prefer not to say',
            'emergency_contacts.*.birthdate'            => 'required|date',
            'emergency_contacts.*.age'                  => 'required|integer|min:0',
            'emergency_contacts.*.contact_number'       => 'required|string|max:20',
            'emergency_contacts.*.relationship_to_client' => 'required|string|max:255',
            'emergency_contacts.*.monthly_income'       => 'nullable|numeric|min:0',
            'emergency_contacts.*.educational_attainment' => 'nullable|string|max:255',
            'household_members'             => 'nullable|array',
            'household_members.*.surname'               => 'required|string|max:255',
            'household_members.*.given_name'            => 'required|string|max:255',
            'household_members.*.middle_name'           => 'nullable|string|max:255',
            'household_members.*.gender'                => 'required|in:Male,Female,Prefer not to say',
            'household_members.*.birthdate'             => 'required|date',
            'household_members.*.age'                   => 'required|integer|min:0',
            'household_members.*.contact_number'        => 'nullable|string|max:20',
            'household_members.*.relationship_to_client' => 'required|string|max:255',
            'household_members.*.monthly_income'        => 'nullable|numeric|min:0',
            'household_members.*.educational_attainment' => 'nullable|string|max:255',
        ]);

        $client = Client::create([
            'client_name'    => "{$data['surname']}, {$data['given_name']}" . ($data['middle_name'] ? ' ' . substr($data['middle_name'],0,1) . '.' : ''),
            'surname'        => $data['surname'],
            'given_name'     => $data['given_name'],
            'middle_name'    => $data['middle_name'] ?? null,
            'gender'         => $data['gender'],
            'age'            => $data['age'],
            'birthdate'      => $data['birthdate'],
            'phone_number'   => $data['contact_number'],
            'civil_status'   => $data['civil_status'],
            'job_status'     => $data['job_status'],
            'province'       => $data['province'],
            'city'           => $data['city'],
            'barangay'       => $data['barangay'],
            'street'         => $data['street'] ?? null,
            'occupation'     => $data['occupation'],
            'monthly_income' => $data['monthly_income'],
            'house_status'   => $data['housing_status'],
            'lot_status'     => $data['lot_status'],
            'philhealth_affiliation' => $data['phicAffiliation'],
            'philhealth_category' => $data['phicAffiliation'] === 'Affiliated' ? $data['phicCategory'] : null,
            'time_registered'=> Carbon::now(),
        ]);

        foreach ($data['emergency_contacts'] ?? [] as $ec) {
            EmergencyContact::create([
                'client_id'       => $client->client_id,
                'surname'         => $ec['surname'],
                'given_name'      => $ec['given_name'],
                'middle_name'     => $ec['middle_name'] ?? null,
                'gender'          => $ec['gender'],
                'age'             => $ec['age'],
                'birthdate'       => $ec['birthdate'],
                'contact_number'  => $ec['contact_number'],
                'relationship'    => $ec['relationship_to_client'],
                'monthly_income'  => $ec['monthly_income'],
                'education'       => $ec['educational_attainment'],
                'time_created'    => Carbon::now(),
            ]);
        }

        foreach ($data['household_members'] ?? [] as $hm) {
            HouseholdMember::create([
                'client_id'       => $client->client_id,
                'surname'         => $hm['surname'],
                'given_name'      => $hm['given_name'],
                'middle_name'     => $hm['middle_name'] ?? null,
                'gender'          => $hm['gender'],
                'age'             => $hm['age'],
                'birthdate'       => $hm['birthdate'],
                'contact_number'  => $hm['contact_number'],
                'relationship'    => $hm['relationship_to_client'],
                'monthly_income'  => $hm['monthly_income'],
                'education'       => $hm['educational_attainment'],
                'time_created'    => Carbon::now(),
            ]);
        }

        return redirect()->route('client-list')->with('success', 'Client created successfully!');
    }
}