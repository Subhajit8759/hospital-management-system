<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-1">Patient Registration</h5>
            <small class="text-muted">Register a new patient</small>
        </div>

        <button type="button" class="btn btn-secondary btn-sm back-to-patients">
            <i class="bi bi-arrow-left"></i> Back
        </button>
    </div>


    <!-- Patient Registration Form -->
    <form id="createPatientForm">

        <!-- Patient Information -->
        <div class="card shadow-sm mb-3">

            <div class="card-header bg-white">
                <h6 class="mb-0">
                    <i class="bi bi-person-vcard me-2"></i>
                    Patient Information
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- UHID -->
                    <div class="col-md-4">
                        <label class="form-label">
                            UHID
                        </label>

                        <input type="text" class="form-control" id="uhid" name="uhid" placeholder="Auto Generated"
                            readonly>
                    </div>


                    <!-- First Name -->
                    <div class="col-md-4">
                        <label class="form-label">
                            First Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" id="first_name" name="first_name"
                            placeholder="Enter first name">
                    </div>


                    <!-- Middle Name -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Middle Name
                        </label>

                        <input type="text" class="form-control" id="middle_name" name="middle_name"
                            placeholder="Enter middle name">
                    </div>


                    <!-- Last Name -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Last Name
                        </label>

                        <input type="text" class="form-control" id="last_name" name="last_name"
                            placeholder="Enter last name">
                    </div>


                    <!-- DOB -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Date of Birth
                        </label>

                        <input type="date" class="form-control" id="patient_dob" name="dob" min="1947-01-01"
                            max="<?= date("Y-m-d"); ?>">
                    </div>


                    <!-- Age -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Age
                        </label>

                        <p class="text-danger text form-control">
                            <span id="age_year">0</span> Years,
                            <span id="age_month">0</span> Months,
                            <span id="age_day">0</span> Days
                        </p>
                    </div>


                    <!-- Gender -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Gender <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" id="gender_id" name="gender_id">

                            <option value="">Select Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>

                        </select>
                    </div>


                    <!-- Blood Group -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Blood Group
                        </label>

                        <select class="form-select" id="blood_group" name="blood_group">

                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>

                        </select>
                    </div>


                    <!-- Marital Status -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Marital Status
                        </label>

                        <select class="form-select" id="marital_status" name="marital_status">

                            <option value="">Select Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>

                        </select>
                    </div>


                    <!-- Nationality -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Nationality
                        </label>

                        <input type="text" class="form-control" id="nationality" name="nationality" value="Indian">
                    </div>

                </div>

            </div>
        </div>


        <!-- Contact Information -->
        <div class="card shadow-sm mb-3">

            <div class="card-header bg-white">
                <h6 class="mb-0">
                    <i class="bi bi-telephone me-2"></i>
                    Contact Information
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- Mobile -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Mobile Number <span class="text-danger">*</span>
                        </label>

                        <input type="tel" class="form-control" id="mobile" name="mobile"
                            placeholder="Enter mobile number">
                    </div>


                    <!-- Alternate Mobile -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Alternate Mobile
                        </label>

                        <input type="tel" class="form-control" id="alternate_mobile" name="alternate_mobile"
                            placeholder="Enter alternate number">
                    </div>


                    <!-- Email -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Email
                        </label>

                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>


                    <!-- Address -->
                    <div class="col-md-12">
                        <label class="form-label">
                            Address <span class="text-danger">*</span>
                        </label>

                        <textarea class="form-control" id="address" name="address" rows="2"
                            placeholder="Enter full address"></textarea>
                    </div>


                    <!-- City -->
                    <div class="col-md-3">
                        <label class="form-label">
                            City / Village
                        </label>

                        <input type="text" class="form-control" name="city">
                    </div>


                    <!-- District -->
                    <div class="col-md-3">
                        <label class="form-label">
                            District
                        </label>

                        <input type="text" class="form-control" name="district">
                    </div>


                    <!-- State -->
                    <div class="col-md-3">
                        <label class="form-label">
                            State
                        </label>

                        <input type="text" class="form-control" name="state" value="West Bengal">
                    </div>


                    <!-- PIN -->
                    <div class="col-md-3">
                        <label class="form-label">
                            PIN Code
                        </label>

                        <input type="text" class="form-control" name="pincode" maxlength="6">
                    </div>

                </div>

            </div>
        </div>


        <!-- Family Information -->
        <div class="card shadow-sm mb-3">

            <div class="card-header bg-white">
                <h6 class="mb-0">
                    <i class="bi bi-people me-2"></i>
                    Family Information
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- Father -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Father's Name
                        </label>

                        <input type="text" class="form-control" name="father_name" placeholder="Enter father's name">
                    </div>


                    <!-- Mother -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Mother's Name
                        </label>

                        <input type="text" class="form-control" name="mother_name" placeholder="Enter mother's name">
                    </div>


                    <!-- Spouse -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Spouse Name
                        </label>

                        <input type="text" class="form-control" name="spouse_name" placeholder="Enter spouse name">
                    </div>


                    <!-- Occupation -->
                    <div class="col-md-4">
                        <label class="form-label">
                            Occupation
                        </label>

                        <input type="text" class="form-control" name="occupation" placeholder="Enter occupation">
                    </div>

                </div>

            </div>
        </div>


        <!-- Identification -->
        <div class="card shadow-sm mb-3">

            <div class="card-header bg-white">
                <h6 class="mb-0">
                    <i class="bi bi-card-text me-2"></i>
                    Identification
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <!-- ID Type -->
                    <div class="col-md-4">
                        <label class="form-label">
                            ID Proof Type
                        </label>

                        <select class="form-select" name="id_proof_type">

                            <option value="">Select ID Proof</option>
                            <option value="aadhaar">Aadhaar</option>
                            <option value="passport">Passport</option>
                            <option value="voter">Voter ID</option>
                            <option value="driving_license">Driving License</option>

                        </select>
                    </div>


                    <!-- ID Number -->
                    <div class="col-md-4">
                        <label class="form-label">
                            ID Proof Number
                        </label>

                        <input type="text" class="form-control" name="id_proof_number" placeholder="Enter ID number">
                    </div>


                    <!-- ABHA -->
                    <div class="col-md-4">
                        <label class="form-label">
                            ABHA ID
                        </label>

                        <input type="text" class="form-control" name="abha_id" placeholder="Enter ABHA ID">
                    </div>


                    <!-- Photo -->
                    <!-- <div class="col-md-4">
                        <label class="form-label">
                            Patient Photo
                        </label>

                        <input type="file" class="form-control" id="photo" name="photo" accept=".jpg,.jpeg,.png">
                    </div> -->

                </div>

            </div>
        </div>


        <!-- Form Buttons -->
        <div class="card shadow-sm">

            <div class="card-body d-flex justify-content-end gap-2">

                <button type="reset" class="btn btn-light border">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </button>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-person-plus"></i>
                    Save Patient
                </button>

            </div>

        </div>

    </form>

</div>