/* ───────── MODALS ───────── */

function openSearch() {
    document.getElementById('searchModal').style.display = 'flex';
    document.getElementById('searchInput').value = '';
    document.getElementById('searchMsg').textContent = '';
}

function closeSearch() {
    document.getElementById('searchModal').style.display = 'none';
}

function openSitin() {
    document.getElementById('sitinModal').style.display = 'flex';
}

function closeSitin() {
    document.getElementById('sitinModal').style.display = 'none';
}

/* ───────── SEARCH STUDENT ───────── */

function searchStudent() {

    let id = document.getElementById('searchInput').value.trim();
    let msg = document.getElementById('searchMsg');

    if (!id) {
        msg.textContent = "Enter student ID";
        return;
    }

    fetch('search.php?student_id=' + encodeURIComponent(id))
        .then(res => res.json())
        .then(data => {

            if (data.found) {

                document.getElementById('show_id').value = data.id;
                document.getElementById('show_name').value = data.name;
                document.getElementById('show_session').value = data.session;

                closeSearch();
                openSitin();

            } else {
                msg.textContent = "Student not found";
            }

        })
        .catch(err => {
            console.log(err);
            msg.textContent = "Server error (search.php)";
        });
}

/* ───────── SIT-IN SUBMIT ───────── */

function submitSitin() {

    let student_id = document.getElementById('show_id').value;
    let purpose = document.getElementById('purpose').value;
    let lab = document.getElementById('lab').value;
    let msg = document.getElementById('sitinMsg');

    if (!student_id || !purpose || !lab) {
        msg.style.color = "#f87171";
        msg.textContent = "Please complete all fields.";
        return;
    }

    fetch('includes/sitinHandler.inc.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body:
            'student_id=' + encodeURIComponent(student_id) +
            '&purpose=' + encodeURIComponent(purpose) +
            '&lab=' + encodeURIComponent(lab)
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {
            msg.style.color = "lightgreen";
            msg.textContent = "Sit-in recorded successfully!";
            setTimeout(() => location.reload(), 800);
        } else {
            msg.style.color = "#f87171";
            msg.textContent = data.message;
        }

    })
    .catch(err => {
        console.log(err);
        msg.textContent = "Server error (handler)";
    });
}