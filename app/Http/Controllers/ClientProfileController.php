<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\EmergencyContact;
use App\Models\HouseholdMember;

class ClientProfileController extends Controller
{
    public function show($id)
    {
        $client = Client::with(['emergencyContacts', 'householdMembers'])
                        ->findOrFail($id);

        return view('clients.profile', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $rules = [
            'surname'                   => 'required|string|max:50',
            'given_name'                => 'required|string|max:50',
            'middle_name'               => 'nullable|string|max:50',
            'gender'                    => ['required', Rule::in(['Male','Female','Prefer not to say'])],
            'birthdate'                 => 'required|date',
            'age'                       => 'required|integer|min:0',
            'phone_number'              => ['required','string', Rule::unique('clients')->ignore($client->client_id, 'client_id')],
            'civil_status'              => ['required', Rule::in(['Single','Married','Widowed','Separated'])],
            'job_status'                => ['required', Rule::in(['Unemployed','Permanent','Contractual','Casual'])],
            'province'                  => 'required|string|max:100',
            'city'                      => 'required|string|max:100',
            'barangay'                  => 'required|string|max:100',
            'street'                    => 'nullable|string|max:255',
            'occupation'                => 'required|string|max:100',
            'monthly_income'            => 'required|numeric|min:0',
            'house_status'              => ['required', Rule::in(['Owner','Renter','House Sharer'])],
            'lot_status'                => ['required', Rule::in(['Owner','Renter','Lot Sharer','Informal Settler'])],
            'philhealth_affiliation'    => ['required', Rule::in(['Unaffiliated','Affiliated'])],
            'philhealth_category'       => [
                'nullable','string',
                Rule::requiredIf($request->philhealth_affiliation === 'Affiliated'),
                Rule::in(['Self-Employed','Sponsored / Indigent','Employed']),
            ],
            'emergency_contacts'                => 'nullable|array',
            'emergency_contacts.*.id'           => 'nullable|exists:emergency_contacts,contact_id',
            'emergency_contacts.*.surname'      => 'required_with:emergency_contacts|string|max:50',
            'emergency_contacts.*.given_name'   => 'required_with:emergency_contacts|string|max:50',
            'emergency_contacts.*.middle_name'  => 'nullable|string|max:50',
            'emergency_contacts.*.gender'       => ['required_with:emergency_contacts', Rule::in(['Male','Female','Prefer not to say'])],
            'emergency_contacts.*.birthdate'    => 'required_with:emergency_contacts|date',
            'emergency_contacts.*.age'          => 'required_with:emergency_contacts|integer|min:0',
            'emergency_contacts.*.contact_number'=> 'required_with:emergency_contacts|string|max:20',
            'emergency_contacts.*.relationship_to_client'=> 'required_with:emergency_contacts|string|max:100',
            'emergency_contacts.*.monthly_income'=> 'required_with:emergency_contacts|numeric|min:0',
            'emergency_contacts.*.educational_attainment'=> ['required_with:emergency_contacts', Rule::in(['College','High School','Elementary'])],
            'household_members'                 => 'nullable|array',
            'household_members.*.id'            => 'nullable|exists:households,household_id',
            'household_members.*.surname'       => 'required_with:household_members|string|max:50',
            'household_members.*.given_name'    => 'required_with:household_members|string|max:50',
            'household_members.*.middle_name'   => 'nullable|string|max:50',
            'household_members.*.gender'        => ['required_with:household_members', Rule::in(['Male','Female','Prefer not to say'])],
            'household_members.*.birthdate'     => 'required_with:household_members|date',
            'household_members.*.age'           => 'required_with:household_members|integer|min:0',
            'household_members.*.contact_number'=> 'required_with:household_members|string|max:20',
            'household_members.*.relationship_to_client'=> 'required_with:household_members|string|max:100',
            'household_members.*.monthly_income'=> 'required_with:household_members|numeric|min:0',
            'household_members.*.educational_attainment'=> ['required_with:household_members', Rule::in(['College','High School','Elementary'])],
        ];

        $validated = $request->validate($rules, [], ['phone_number' => 'phone number']);

        $dataToUpdate = [
            'surname'                 => $validated['surname'],
            'given_name'              => $validated['given_name'],
            'middle_name'             => $validated['middle_name'],
            'gender'                  => $validated['gender'],
            'birthdate'               => $validated['birthdate'],
            'age'                     => $validated['age'],
            'phone_number'            => $validated['phone_number'],
            'civil_status'            => $validated['civil_status'],
            'job_status'              => $validated['job_status'],
            'province'                => $validated['province'],
            'city'                    => $validated['city'],
            'barangay'                => $validated['barangay'],
            'street'                  => $validated['street'],
            'occupation'              => $validated['occupation'],
            'monthly_income'          => $validated['monthly_income'],
            'house_status'            => $validated['house_status'],
            'lot_status'              => $validated['lot_status'],
            'philhealth_affiliation'  => $validated['philhealth_affiliation'],
            'philhealth_category'     => $validated['philhealth_affiliation'] === 'Affiliated'
                                            ? $validated['philhealth_category']
                                            : null,
        ];

        DB::transaction(function() use ($client, $validated, $dataToUpdate) {
            $client->update($dataToUpdate);

            $existingEC = EmergencyContact::where('client_id', $client->client_id)
                                         ->pluck('contact_id')
                                         ->toArray();
            $keepEC = [];
            foreach ($validated['emergency_contacts'] ?? [] as $ec) {
                if (!empty($ec['id'])) {
                    $contact = EmergencyContact::find($ec['id']);
                    $contact->update([
                        'surname'        => $ec['surname'],
                        'given_name'     => $ec['given_name'],
                        'middle_name'    => $ec['middle_name'] ?? null,
                        'gender'         => $ec['gender'],
                        'birthdate'      => $ec['birthdate'],
                        'age'            => $ec['age'],
                        'contact_number' => $ec['contact_number'],
                        'relationship'   => $ec['relationship_to_client'],
                        'monthly_income' => $ec['monthly_income'],
                        'education'      => $ec['educational_attainment'],
                    ]);
                    $keepEC[] = $ec['id'];
                } else {
                    $newId = 'EC-' . date('Y') . '-' . str_pad(
                        intval(EmergencyContact::where('contact_id','like', 'EC-'.date('Y').'-%')->count())+1,
                        6,'0',STR_PAD_LEFT
                    );
                    $new = EmergencyContact::create([
                        'contact_id'       => $newId,
                        'client_id'        => $client->client_id,
                        'surname'          => $ec['surname'],
                        'given_name'       => $ec['given_name'],
                        'middle_name'      => $ec['middle_name'] ?? null,
                        'gender'           => $ec['gender'],
                        'birthdate'        => $ec['birthdate'],
                        'age'              => $ec['age'],
                        'contact_number'   => $ec['contact_number'],
                        'relationship'     => $ec['relationship_to_client'],
                        'monthly_income'   => $ec['monthly_income'],
                        'education'        => $ec['educational_attainment'],
                        'time_created'     => now(),
                    ]);
                    $keepEC[] = $new->contact_id;
                }
            }
            EmergencyContact::where('client_id', $client->client_id)
                            ->whereNotIn('contact_id', $keepEC)
                            ->delete();

            $existingHM = HouseholdMember::where('client_id', $client->client_id)
                                         ->pluck('household_id')
                                         ->toArray();
            $keepHM = [];
            foreach ($validated['household_members'] ?? [] as $hm) {
                if (!empty($hm['id'])) {
                    $member = HouseholdMember::find($hm['id']);
                    $member->update([
                        'surname'        => $hm['surname'],
                        'given_name'     => $hm['given_name'],
                        'middle_name'    => $hm['middle_name'] ?? null,
                        'gender'         => $hm['gender'],
                        'birthdate'      => $hm['birthdate'],
                        'age'            => $hm['age'],
                        'contact_number' => $hm['contact_number'],
                        'relationship'   => $hm['relationship_to_client'],
                        'monthly_income' => $hm['monthly_income'],
                        'education'      => $hm['educational_attainment'],
                    ]);
                    $keepHM[] = $hm['id'];
                } else {
                    $newId = 'HM-' . date('Y') . '-' . str_pad(
                        intval(HouseholdMember::where('household_id','like', 'HM-'.date('Y').'-%')->count())+1,
                        6,'0',STR_PAD_LEFT
                    );
                    $new = HouseholdMember::create([
                        'household_id'     => $newId,
                        'client_id'        => $client->client_id,
                        'surname'          => $hm['surname'],
                        'given_name'       => $hm['given_name'],
                        'middle_name'      => $hm['middle_name'] ?? null,
                        'gender'           => $hm['gender'],
                        'birthdate'        => $hm['birthdate'],
                        'age'              => $hm['age'],
                        'contact_number'   => $hm['contact_number'],
                        'relationship'     => $hm['relationship_to_client'],
                        'monthly_income'   => $hm['monthly_income'],
                        'education'        => $hm['educational_attainment'],
                        'time_created'     => now(),
                    ]);
                    $keepHM[] = $new->household_id;
                }
            }
            HouseholdMember::where('client_id', $client->client_id)
                           ->whereNotIn('household_id', $keepHM)
                           ->delete();
        });

        return redirect()
               ->route('client.profile.show', $client->client_id)
               ->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();

        return redirect()
               ->route('client-list')
               ->with('success', 'Client deleted successfully.');
    }
}