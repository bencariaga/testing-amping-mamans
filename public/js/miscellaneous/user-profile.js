document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password_display_current');
    const toggleIcon = document.getElementById('toggleIcon');

    if (togglePassword && passwordField && toggleIcon) {
        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            if (type === 'password') {
                toggleIcon.classList.remove('bi-eye-slash-fill');
                toggleIcon.classList.add('bi-eye-fill');
            } else {
                toggleIcon.classList.remove('bi-eye-fill');
                toggleIcon.classList.add('bi-eye-slash-fill');
            }
        });
    }

    const removeProfilePictureBtn = document.querySelector('.remove-profile-picture-btn');

    if (removeProfilePictureBtn) {
        removeProfilePictureBtn.addEventListener('click', function () {
            const flagInput = document.getElementById('remove_profile_picture_flag');

            flagInput.value = '1';
            alert('Profile picture will be removed upon saving changes.');

            const profilePicElem = document.querySelector('.profile-pic');
            const avatarPlaceholderElem = document.querySelector('.avatar-placeholder');

            if (profilePicElem) profilePicElem.style.display = 'none';
            if (avatarPlaceholderElem) avatarPlaceholderElem.style.display = 'flex';
        });
    }

    const profilePicUpload = document.getElementById('profile_picture_upload');
    const profilePicImages = document.querySelectorAll('.profile-pic, .avatar-placeholder');

    profilePicImages.forEach(element => {
        element.addEventListener('click', function () {
            profilePicUpload.click();
        });
    });

    if (profilePicUpload) {
        profilePicUpload.addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                const existingPic = document.querySelector('.profile-pic');
                const existingPlaceholder = document.querySelector('.avatar-placeholder');

                if (existingPic) {
                    existingPic.src = URL.createObjectURL(file);
                    existingPic.style.display = 'block';

                    if (existingPlaceholder) existingPlaceholder.style.display = 'none';
                } else if (existingPlaceholder) {
                    const newImg = document.createElement('img');

                    newImg.classList.add('img-thumbnail', 'rounded-circle', 'profile-pic');
                    newImg.src = URL.createObjectURL(file);

                    existingPlaceholder.parentNode.insertBefore(newImg, existingPlaceholder);
                    existingPlaceholder.style.display = 'none';

                    newImg.addEventListener('click', function () {
                        profilePicUpload.click();
                    });
                }

                const flagInput = document.getElementById('remove_profile_picture_flag');
                flagInput.value = '0';
            }
        });
    }
});