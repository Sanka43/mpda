document.addEventListener('DOMContentLoaded', () => {
    const whatsapp = '94' + String(window.MPDA_WHATSAPP || '772454288').replace(/^0/, '');

    function openWhatsApp(message) {
        window.location.href = 'https://wa.me/' + whatsapp + '?text=' + encodeURIComponent(message);
    }

    function fieldValue(form, name) {
        const input = form.elements.namedItem(name);
        return input ? String(input.value || '').trim() : '';
    }

    document.querySelectorAll('[data-mpda-form]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const type = form.dataset.mpdaForm;

            if (type === 'register') {
                const branchSelect = form.elements.namedItem('preferred_branch_id');
                const branchLabel = branchSelect && branchSelect.selectedOptions[0]
                    ? branchSelect.selectedOptions[0].text
                    : 'N/A';

                openWhatsApp(
                    'MPDA Registration\n\n'
                    + 'Student: ' + fieldValue(form, 'student_name') + '\n'
                    + 'Parent: ' + fieldValue(form, 'parent_name') + '\n'
                    + 'Gender: ' + fieldValue(form, 'gender') + '\n'
                    + 'Age: ' + fieldValue(form, 'age') + '\n'
                    + 'Address: ' + fieldValue(form, 'address') + '\n'
                    + 'Phone: ' + fieldValue(form, 'phone') + '\n'
                    + 'Emergency: ' + fieldValue(form, 'emergency_phone') + '\n'
                    + 'School: ' + (fieldValue(form, 'school') || 'N/A') + '\n'
                    + 'Student DOB: ' + (fieldValue(form, 'student_dob') || 'N/A') + '\n'
                    + 'Mother DOB: ' + (fieldValue(form, 'mother_dob') || 'N/A') + '\n'
                    + 'Guardian NIC: ' + (fieldValue(form, 'guardian_nic') || 'N/A') + '\n'
                    + 'Guardian Job: ' + (fieldValue(form, 'guardian_job') || 'N/A') + '\n'
                    + 'Branch: ' + branchLabel
                );
                return;
            }

            if (type === 'contact') {
                openWhatsApp(
                    'MPDA Contact Message\n\n'
                    + 'Name: ' + fieldValue(form, 'name') + '\n'
                    + 'Email: ' + fieldValue(form, 'email') + '\n'
                    + 'Phone: ' + (fieldValue(form, 'phone') || 'N/A') + '\n'
                    + 'Subject: ' + (fieldValue(form, 'subject') || 'N/A') + '\n\n'
                    + fieldValue(form, 'message')
                );
                return;
            }

            if (type === 'feedback') {
                openWhatsApp(
                    'MPDA Parent Feedback\n\n'
                    + 'Parent: ' + fieldValue(form, 'parent_name') + '\n'
                    + 'Student: ' + (fieldValue(form, 'student_name') || 'N/A') + '\n'
                    + 'Rating: ' + fieldValue(form, 'rating') + '/5\n\n'
                    + fieldValue(form, 'content')
                );
            }
        });
    });
});
