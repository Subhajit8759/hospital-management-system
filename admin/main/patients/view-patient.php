<style>
.card {
    border: none;
    border-radius: 8px;
}

.card-header {
    background-color: #f8f9fa;
    padding: 12px 15px;
    border-bottom: 1px solid #dee2e6;
}

.card-body {
    padding: 20px;
}

.card-body h6 {
    font-size: 14px;
    font-weight: 500;
    margin-top: 5px;
    margin-bottom: 0;
}

.card-body small {
    font-size: 12px;
}
</style>

<div class="container-fluid p-3">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Patient Details</h4>

        <div>
            <a href="index.php?page=patients" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>

            <button type="button" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil"></i> Edit
            </button>
        </div>
    </div>

    <!-- Patient Basic Information -->
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Patient Information</h6>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-3 text-center mb-3">
                    <img src="https://placehold.co/120x120"
                         class="rounded-circle img-thumbnail"
                         width="120"
                         height="120"
                         alt="Patient Photo">
                </div>

                <div class="col-md-9">
                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">UHID</small>
                            <h6>HMS000101</h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">Patient Name</small>
                            <h6>Rahul Santra</h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">Gender</small>
                            <h6>Male</h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">Date of Birth</small>
                            <h6>15 May 2000</h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">Age</small>
                            <h6>26 Years</h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">Blood Group</small>
                            <h6>B+</h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">Nationality</small>
                            <h6>Indian</h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">Marital Status</small>
                            <h6>Single</h6>
                        </div>

                        <div class="col-md-4 mb-3">
                            <small class="text-muted">Registration Date</small>
                            <h6>01 October 2026</h6>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="card shadow-sm mb-3">
        <div class="card-header">
            <h6 class="mb-0">Contact Information</h6>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <small class="text-muted">Mobile Number</small>
                    <h6>9876543210</h6>
                </div>

                <div class="col-md-4 mb-3">
                    <small class="text-muted">Email</small>
                    <h6>rahul@example.com</h6>
                </div>

                <div class="col-md-4 mb-3">
                    <small class="text-muted">Emergency Contact</small>
                    <h6>9876501234</h6>
                </div>

                <div class="col-md-12 mb-2">
                    <small class="text-muted">Address</small>
                    <h6>12, Kolkata, West Bengal, India</h6>
                </div>

            </div>
        </div>
    </div>

    <!-- Emergency Contact Information -->
    <div class="card shadow-sm mb-3">
        <div class="card-header">
            <h6 class="mb-0">Emergency Contact Information</h6>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <small class="text-muted">Contact Person</small>
                    <h6>Ramesh Santra</h6>
                </div>

                <div class="col-md-4 mb-3">
                    <small class="text-muted">Relationship</small>
                    <h6>Father</h6>
                </div>

                <div class="col-md-4 mb-3">
                    <small class="text-muted">Contact Number</small>
                    <h6>9876501234</h6>
                </div>

            </div>
        </div>
    </div>

</div>