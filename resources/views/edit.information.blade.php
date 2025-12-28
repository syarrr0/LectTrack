@extends('layouts.app')

@section('content')

<style>
    /* Blur background bila modal muncul */
    body.modal-open {
        overflow: hidden;
    }

    .blur-background {
        filter: blur(6px);
        transition: 0.3s;
    }

    /* Modal styling */
    .modal-custom {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0,0,0,0.45);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal-box {
        width: 500px;
        background: white;
        border-radius: 15px;
        padding: 30px;
        animation: fadeIn .3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to   { opacity: 1; transform: scale(1); }
    }

    .title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
        text-align: center;
    }
</style>

<div id="mainContent" class="p-5">
    <h2 class="text-white mb-4">Lecturer Information</h2>

    <!-- Profile Content -->
    <div class="text-center mb-3">
        <img src="/images/profile.png" width="150" style="border-radius: 100px;">
        <br><br>

        <button onclick="openModal()" 
            class="btn btn-light fw-bold px-4 py-2 rounded-pill">
            EDIT INFORMATION
        </button>
    </div>

    <div class="p-4 bg-light rounded-4" style="width: 55%; margin: auto;">
        <h5><b>Personal Information</b></h5>
        <hr>
        <p><b>Name:</b> {{ $lecturer->name }}</p>
        <p><b>Department:</b> {{ $lecturer->department }}</p>
        <p><b>ID Number:</b> {{ $lecturer->staff_id }}</p>
        <p><b>Phone Number:</b> {{ $lecturer->phone }}</p>
        <p><b>Email:</b> {{ $lecturer->email }}</p>
    </div>
</div>


<!-- ==============================
     MODAL EDIT FORM
================================== -->
<div id="editModal" class="modal-custom" style="display:none;">
    <div class="modal-box">

        <div class="title">Edit Personal Information</div>

        <form action="{{ route('lecturer.update', $lecturer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="fw-bold">Name:</label>
            <input type="text" name="name" class="form-control mb-2"
                value="{{ $lecturer->name }}" required>

            <label class="fw-bold">Department:</label>
            <input type="text" name="department" class="form-control mb-2"
                value="{{ $lecturer->department }}" required>

            <label class="fw-bold">ID Number:</label>
            <input type="text" name="staff_id" class="form-control mb-2"
                value="{{ $lecturer->staff_id }}">

            <label class="fw-bold">Phone Number:</label>
            <input type="text" name="phone" class="form-control mb-2"
                value="{{ $lecturer->phone }}">

            <label class="fw-bold">Email:</label>
            <input type="email" name="email" class="form-control mb-4"
                value="{{ $lecturer->email }}">

            <div class="d-flex justify-content-between">
                <button type="button" onclick="closeModal()" class="btn btn-secondary px-4">
                    Cancel
                </button>

                <button type="submit" class="btn btn-primary px-4">
                    Save
                </button>
            </div>
        </form>

    </div>
</div>


<script>
    function openModal() {
        document.getElementById("editModal").style.display = "flex";
        document.getElementById("mainContent").classList.add("blur-background");
        document.body.classList.add("modal-open");
    }

    function closeModal() {
        document.getElementById("editModal").style.display = "none";
        document.getElementById("mainContent").classList.remove("blur-background");
        document.body.classList.remove("modal-open");
    }
</script>

@endsection
