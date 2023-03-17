<x-admin-layout>
    <div class="container" class="border ">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">

                <button onclick="registerWithEmail()" class="btn btn-secondary">Register with Email</button>
                <button onclick=" registerWithNumber()" id="withNumber" class="btn btn-secondary">Register with
                    Number</button>
                <form action="{{ route('admin.storeUser') }}" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name"
                            placeholder="first name">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name"
                            placeholder="last name">
                    </div>
                    <div class="mb-3" id="email">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="emailInput" name="email" class="form-control" placeholder="email">
                    </div>
                    <div class="mb-3" id="phone_number">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="number" id="numberInput" name="phone_number" class="form-control"
                            placeholder="phone number">
                    </div>
                    <div class="mb-3" id="password">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="password">
                    </div>

                    <button class="btn btn-success text-black" type="submit">Add User</button>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</x-admin-layout>

<script>
    function registerWithEmail() {
        document.getElementById('email').style.display = "block";
        document.getElementById('phone_number').style.display = "none";
        document.getElementById('numberInput').value = "";
    }

    function registerWithNumber() {
        document.getElementById('phone_number').style.display = "block";
        document.getElementById('email').style.display = "none";
        document.getElementById('emailInput').value = "";
    }
</script>
