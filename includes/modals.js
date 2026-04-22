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

/* ───────── SEARCH STUDENT (FIXED) ───────── */

function searchStudent() {

    let id = document.getElementById('searchInput').value.trim();
    let msg = document.getElementById('searchMsg');

    if (id === '') {
        msg.textContent = "Enter student ID";
        return;
    }

    fetch('search.php?student_id=' + encodeURIComponent(id))
        .then(res => res.json())
        .then(data => {

            if (data.found) {

                // FIXED mapping (NO undefined anymore)
                document.getElementById('show_id').value = data.id;
                document.getElementById('show_name').value = data.name;
                document.getElementById('show_session').value = data.session;

                closeSearch();
                openSitin();

            } else {
                msg.textContent = "Student not found";
            }

        })
        .catch(() => {
            msg.textContent = "Server error";
        });
}

/* ───────── SIT-IN (placeholder safe version) ───────── */
/* (You deleted handler earlier, so this prevents errors) */

function submitSitin() {
    let msg = document.getElementById('sitinMsg');
    msg.style.color = "#f87171";
    msg.textContent = "Sit-in handler not connected yet.";
}