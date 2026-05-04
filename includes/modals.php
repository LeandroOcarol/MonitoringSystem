<!-- SEARCH MODAL -->
<div id="searchModal" class="modal-overlay">
    <div class="modal-box" style="width:360px;">
        <button class="modal-close" onclick="closeSearch()">&times;</button>
        <h3 class="modal-title">Search Student</h3>
        <div class="modal-field">
            <label class="modal-label">Student ID</label>
            <input type="text" id="searchInput" class="modal-input">
        </div>
        <p id="searchMsg" class="modal-error"></p>
        <button class="modal-btn-full" onclick="searchStudent()">Search</button>
    </div>
</div>

<!-- SIT-IN MODAL -->
<div id="sitinModal" class="modal-overlay">
    <div class="modal-box" style="width:420px;">
        <button class="modal-close" onclick="closeSitin()">&times;</button>
        <h3 class="modal-title">Sit In Form</h3>
        <div style="display:flex; flex-direction:column; gap:14px;">
            <div class="modal-field">
                <label class="modal-label">ID Number</label>
                <input type="text" id="show_id" class="modal-input-readonly" readonly>
            </div>
            <div class="modal-field">
                <label class="modal-label">Student Name</label>
                <input type="text" id="show_name" class="modal-input-readonly" readonly>
            </div>
            <div class="modal-field">
                <label class="modal-label">Purpose</label>
                <select id="purpose" class="modal-select">
                    <option value="">-- Select --</option>
                    <option value="C Programming">C Programming</option>
                    <option value="Java Programming">Java Programming</option>
                </select>
            </div>
            <div class="modal-field">
                <label class="modal-label">Lab</label>
                <input type="text" id="lab" class="modal-input">
            </div>
            <div class="modal-field">
                <label class="modal-label">Remaining Session</label>
                <input type="text" id="show_session" class="modal-input-readonly" readonly>
            </div>
            <p id="sitinMsg" class="modal-error"></p>
            <div class="modal-footer">
                <button class="modal-btn-close" onclick="closeSitin()">Close</button>
                <button class="modal-btn-primary" onclick="submitSitin()">Sit In</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal-overlay">
    <div class="modal-box" style="width:500px;">
        <button class="modal-close" onclick="closeEditModal()">&times;</button>
        <h3 class="modal-title">Edit Student Profile</h3>
        <div id="editFormContent"></div>
    </div>
</div>

<!-- ADD MODAL -->
<div id="addModal" class="modal-overlay">
    <div class="modal-box" style="width:420px;">
        <button class="modal-close" onclick="closeAddModal()">&times;</button>
        <h3 class="modal-title">Add New Student</h3>
        <form action="includes/adminStudentHandler.inc.php" method="POST">
            <div style="display:flex; flex-direction:column; gap:14px;">
                <div class="modal-field">
                    <label class="modal-label">ID Number</label>
                    <input type="text" name="id" class="modal-input" required>
                </div>
                <div class="modal-field">
                    <label class="modal-label">First Name</label>
                    <input type="text" name="first_name" class="modal-input" required>
                </div>
                <div class="modal-field">
                    <label class="modal-label">Last Name</label>
                    <input type="text" name="last_name" class="modal-input" required>
                </div>
                <div class="modal-field">
                    <label class="modal-label">Password</label>
                    <input type="password" name="password" class="modal-input" required>
                    <small class="field-hint">Minimum 8 characters</small>
                </div>
                <div class="modal-field">
                    <label class="modal-label">Repeat Password</label>
                    <input type="password" name="repeat_password" class="modal-input" required>
                </div>
                <div class="modal-field">
                    <label class="modal-label">Course</label>
                    <select name="course" class="modal-select" required>
                        <option value="" disabled selected>-- Select Course --</option>
                        <option value="BSIT">BSIT - Bachelor of Science in Information Technology</option>
                        <option value="BSCS">BSCS - Bachelor of Science in Computer Science</option>
                        <option value="BSA">BSA - Bachelor of Science in Accountancy</option>
                        <option value="BSMA">BSMA - Bachelor of Science in Management Accounting</option>
                        <option value="BSBA">BSBA - Bachelor of Science in Business Administration</option>
                        <option value="BSOA">BSOA - Bachelor of Science in Office Administration</option>
                        <option value="BSCE">BSCE - Bachelor of Science in Civil Engineering</option>
                        <option value="BSECE">BSECE - Bachelor of Science in Electronics Engineering</option>
                        <option value="BSME">BSME - Bachelor of Science in Mechanical Engineering</option>
                        <option value="BSEE">BSEE - Bachelor of Science in Electrical Engineering</option>
                        <option value="BSCrim">BSCrim - Bachelor of Science in Criminology</option>
                        <option value="BEED">BEED - Bachelor of Elementary Education</option>
                        <option value="BSED">BSED - Bachelor of Secondary Education</option>
                        <option value="BSHM">BSHM - Bachelor of Science in Hospitality Management</option>
                        <option value="BSTM">BSTM - Bachelor of Science in Tourism Management</option>
                        <option value="ABCOMM">ABCOMM - AB Communication</option>
                        <option value="ABPolSci">ABPolSci - AB Political Science</option>
                        <option value="BSN">BSN - Bachelor of Science in Nursing</option>
                    </select>
                </div>
                <div class="modal-field">
                    <label class="modal-label">Year Level</label>
                    <select name="course_level" class="modal-select" required>
                        <option value="" disabled selected>-- Select Course Level --</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn-close" onclick="closeAddModal()">Cancel</button>
                    <button type="submit" name="add_student" class="modal-btn-primary">Add Student</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

/* ═══════════════════════════════════════
   TABLE: PAGINATION, SEARCH, SORT
═══════════════════════════════════════ */

let currentPage = 1;
let entriesPerPage = 10;
let sortCol = -1;
let sortAsc = true;
let allRows = [];

// Grab all rows once on load
window.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('studentTableBody');
    allRows = Array.from(tbody.querySelectorAll('tr'));
    renderTable();
});

function changeEntries(val) {
    entriesPerPage = parseInt(val);
    currentPage = 1;
    renderTable();
}

function filterTable() {
    currentPage = 1;
    renderTable();
}

function sortTable(col) {
    if (sortCol === col) {
        sortAsc = !sortAsc;
    } else {
        sortCol = col;
        sortAsc = true;
    }

    // Update sort icons
    document.querySelectorAll('.sort-icon').forEach((el, i) => {
        el.textContent = i === col ? (sortAsc ? '↑' : '↓') : '↕';
    });

    allRows.sort((a, b) => {
        const aText = a.cells[col].textContent.trim().toLowerCase();
        const bText = b.cells[col].textContent.trim().toLowerCase();
        const aNum = parseFloat(aText);
        const bNum = parseFloat(bText);
        if (!isNaN(aNum) && !isNaN(bNum)) {
            return sortAsc ? aNum - bNum : bNum - aNum;
        }
        return sortAsc ? aText.localeCompare(bText) : bText.localeCompare(aText);
    });

    renderTable();
}

function getFilteredRows() {
    const query = document.getElementById('tableSearch').value.toLowerCase();
    if (!query) return allRows;
    return allRows.filter(row => row.textContent.toLowerCase().includes(query));
}

function renderTable() {
    const filtered = getFilteredRows();
    const total = filtered.length;
    const totalPages = Math.max(1, Math.ceil(total / entriesPerPage));
    if (currentPage > totalPages) currentPage = totalPages;

    const start = (currentPage - 1) * entriesPerPage;
    const end = start + entriesPerPage;

    const tbody = document.getElementById('studentTableBody');
    tbody.innerHTML = '';
    filtered.slice(start, end).forEach(row => tbody.appendChild(row));

    // Info text
    const showing = total === 0 ? 0 : start + 1;
    const showingEnd = Math.min(end, total);
    document.getElementById('tableInfo').textContent =
        `Showing ${showing} to ${showingEnd} of ${total} entries`;

    // Pagination buttons
    const pc = document.getElementById('paginationControls');
    pc.innerHTML = '';

    const prevBtn = document.createElement('button');
    prevBtn.className = 'pagination-btn';
    prevBtn.textContent = 'Previous';
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => { currentPage--; renderTable(); };
    pc.appendChild(prevBtn);

    // Page number buttons (show up to 5)
    const range = 2;
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - range && i <= currentPage + range)) {
            const btn = document.createElement('button');
            btn.className = 'pagination-btn' + (i === currentPage ? ' active' : '');
            btn.textContent = i;
            btn.onclick = ((p) => () => { currentPage = p; renderTable(); })(i);
            pc.appendChild(btn);
        } else if (
            (i === currentPage - range - 1 || i === currentPage + range + 1)
        ) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'pagination-ellipsis';
            ellipsis.textContent = '…';
            pc.appendChild(ellipsis);
        }
    }

    const nextBtn = document.createElement('button');
    nextBtn.className = 'pagination-btn';
    nextBtn.textContent = 'Next';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.onclick = () => { currentPage++; renderTable(); };
    pc.appendChild(nextBtn);
}

/* ═══════════════════════════════════════
   SEARCH MODAL
═══════════════════════════════════════ */

function openSearch() {
    document.getElementById('searchModal').style.display = 'flex';
    document.getElementById('searchInput').value = '';
    document.getElementById('searchMsg').textContent = '';
}

function closeSearch() {
    document.getElementById('searchModal').style.display = 'none';
}

/* ═══════════════════════════════════════
   SIT-IN MODAL
═══════════════════════════════════════ */

function openSitin() {
    document.getElementById('sitinModal').style.display = 'flex';
}

function closeSitin() {
    document.getElementById('sitinModal').style.display = 'none';
}

function searchStudent() {
    let id = document.getElementById('searchInput').value.trim();
    let msg = document.getElementById('searchMsg');

    if (!id) { msg.textContent = "Enter student ID"; return; }

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
        .catch(err => { console.log(err); msg.textContent = "Server error (search.php)"; });
}

function submitSitin() {
    let student_id = document.getElementById('show_id').value;
    let purpose    = document.getElementById('purpose').value;
    let lab        = document.getElementById('lab').value;
    let msg        = document.getElementById('sitinMsg');

    if (!student_id || !purpose || !lab) {
        msg.style.color = "#f87171";
        msg.textContent = "Please complete all fields.";
        return;
    }

    fetch('includes/sitinHandler.inc.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'student_id=' + encodeURIComponent(student_id) +
              '&purpose='   + encodeURIComponent(purpose) +
              '&lab='       + encodeURIComponent(lab)
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
        .catch(err => { console.log(err); msg.textContent = "Server error (sitinHandler)"; });
}

/* ═══════════════════════════════════════
   DELETE
═══════════════════════════════════════ */

function deleteStudent(id) {
    if (confirm('Are you sure you want to delete this student?')) {
        fetch('includes/adminStudentHandler.inc.php?delete_id=' + id)
            .then(res => res.text())
            .then(() => location.reload());
    }
}

/* ═══════════════════════════════════════
   EDIT MODAL
═══════════════════════════════════════ */

function openEditModal(id) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('editFormContent').innerHTML =
        '<p style="color:rgba(255,255,255,0.5); font-size:14px;">Loading...</p>';

    fetch('includes/adminStudentHandler.inc.php?get_student=' + id)
        .then(res => res.json())
        .then(data => {
            if (!data || !data.id) {
                document.getElementById('editFormContent').innerHTML =
                    '<p style="color:#f87171;">Failed to load student data.</p>';
                return;
            }
            document.getElementById('editFormContent').innerHTML = `
                <form action="includes/adminStudentHandler.inc.php" method="POST">
                    <input type="hidden" name="id" value="${data.id}">
                    <div style="display:flex; flex-direction:column; gap:14px;">
                        <div class="modal-field">
                            <label class="modal-label">ID Number</label>
                            <input type="text" class="modal-input-readonly" value="${data.id}" readonly>
                        </div>
                        <div class="modal-field">
                            <label class="modal-label">First Name</label>
                            <input type="text" name="first_name" class="modal-input" value="${data.first_name}" required>
                        </div>
                        <div class="modal-field">
                            <label class="modal-label">Last Name</label>
                            <input type="text" name="last_name" class="modal-input" value="${data.last_name}" required>
                        </div>
                        <div class="modal-field">
                            <label class="modal-label">Course</label>
                            <input type="text" name="course" class="modal-input" value="${data.course}" required>
                        </div>
                        <div class="modal-field">
                            <label class="modal-label">Year Level</label>
                            <input type="text" name="course_level" class="modal-input" value="${data.course_level}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-btn-close" onclick="closeEditModal()">Cancel</button>
                            <button type="submit" name="edit_student" class="modal-btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>`;
        })
        .catch(err => {
            console.log(err);
            document.getElementById('editFormContent').innerHTML =
                '<p style="color:#f87171;">Server error loading student.</p>';
        });
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

/* ═══════════════════════════════════════
   ADD MODAL
═══════════════════════════════════════ */

function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

/* ═══════════════════════════════════════
   LOGOUT SIT-IN
═══════════════════════════════════════ */

function logoutSitin(sitId) {
    if (confirm('Are you sure you want to log out this student?')) {
        fetch('includes/logout_sitin.inc.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'sit_id=' + encodeURIComponent(sitId)
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Student logged out successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(err => { console.log(err); alert('Server error'); });
    }
}

</script>