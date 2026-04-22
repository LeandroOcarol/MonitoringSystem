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

            <!-- FIXED SESSION FIELD -->
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