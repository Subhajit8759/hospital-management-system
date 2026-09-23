<?php
    include "../configs/session_handling.php";
?>

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="bi bi-building me-2"></i>
            Create Department
        </h5>

        <button type="button"
                class="btn btn-secondary btn-sm back-to-department"
                id="backToDepartments" >

            <i class="bi bi-arrow-left me-1"></i>
            Back

        </button>

    </div>


    <div class="card-body">

        <form id="createDepartmentForm">

            <div class="row">

                <!-- Department Name -->
                <div class="col-md-6 mb-3">

                    <label for="dept_name" class="form-label">
                        Department Name
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           class="form-control"
                           id="dept_name"
                           name="dept_name"
                           placeholder="Enter department name">

                </div>


                <!-- Department Code -->
                <div class="col-md-6 mb-3">

                    <label for="dept_code" class="form-label">
                        Department Code
                        <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           class="form-control"
                           id="dept_code"
                           name="dept_code"
                           placeholder="Enter department code">

                    <small class="text-muted">
                        Example: CARD, NEPH, PATH
                    </small>

                </div>


                <!-- Description -->
                <div class="col-12 mb-3">

                    <label for="dept_description" class="form-label">
                        Department Description
                    </label>

                    <textarea class="form-control"
                              id="dept_description"
                              name="dept_description"
                              rows="4"
                              maxlength="255"
                              placeholder="Enter department description"></textarea>

                    <div class="text-end">
                        <small class="text-muted">
                            Maximum 255 characters
                        </small>
                    </div>

                </div>


                <!-- Status -->
                <div class="col-md-6 mb-3">

                    <label for="status" class="form-label">
                        Status
                        <span class="text-danger">*</span>
                    </label>

                    <select class="form-select"
                            id="status"
                            name="dept_status">

                        <option selected disabled value="0">Select Status</option>

                        <option value="1" selected>
                            Active
                        </option>

                        <option value="2">
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            <!-- Buttons -->
            <div class="mt-3">

                <button type="submit"
                        class="btn btn-primary"
                        id="saveDepartmentBtn">

                    <i class="bi bi-check-lg me-1"></i>
                    Save Department

                </button>


                <button type="reset"
                        class="btn btn-secondary">

                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Reset

                </button>

            </div>

        </form>

    </div>

</div>