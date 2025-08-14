<h1>Register as a Candidate</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="input-field">
        <label for="firstName">Enter First Name</label>
        <input
            type="text"
            placeholder="First Name"
            name="firstName"
            required
            value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="lastName">Enter Last Name</label>
        <input
            type="text"
            placeholder="Last Name"
            name="lastName"
            required
            value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="email">Enter Email Address</label>
        <input
            type="email"
            placeholder="Email"
            name="email"
            required
            value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
            style="<?= !empty($errors['email']) ? 'border: 2px solid red;' : '' ?>">
    </div>
    <?php if (!empty($errors['email'])): ?>
        <div style="color:red;" class="error"><?= $errors['email'] ?></div>
    <?php endif; ?>

    <div class="input-field">
        <label for="dob">Enter Date of Birth</label>
        <input
            type="date"
            placeholder="Date of Birth"
            name="dob"
            required
            value="<?= isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="address">Enter Residential Address</label>
        <input
            type="text"
            placeholder="Enter your full Address here "
            name="address"
            required
            value="<?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="candidate_photo_path">Insert a photo of yourself</label>
        <input
            type="file"
            name="candidate_photo_path"
            required
            accept=".pdf, .jpg, .jpeg, .png"
            style="<?= !empty($errors['candidate_photo_path']) ? 'border: 2px solid red;' : '' ?>">
    </div>
    <?php if (!empty($errors['candidate_photo_path'])): ?>
        <div style="color:red;" class="error"><?= $errors['candidate_photo_path'] ?></div>
    <?php endif; ?>

    <div class="input-field">
        <label for="contactNo">Enter Contact Number</label>
        <input
            type="tel"
            placeholder="Contact Number:07xxxxxxxx"
            name="contactNo"
            pattern="[0-9]{10}"
            required
            value="<?= isset($_POST['contactNo']) ? htmlspecialchars($_POST['contactNo']) : '' ?>">
    </div>

    <div class="input-field">
        <label for="password">Enter Password</label>
        <input
            type="password"
            placeholder="Password"
            name="password"
            required>
    </div>

    <div class="input-field">
        <label for="confirm_password">Re-enter the Pasword</label>
        <input
            type="password"
            placeholder="Confirm Password"
            name="confirm_password"
            required
            style="<?= !empty($errors['confirm_password']) ? 'border: 2px solid red;' : '' ?>">
    </div>
    <?php if (!empty($errors['confirm_password'])): ?>
        <div style="color:red; padding-bottom:15px;" class="error"><?= $errors['confirm_password'] ?></div>
    <?php endif; ?>

    <button type="submit">Register</button>
</form>