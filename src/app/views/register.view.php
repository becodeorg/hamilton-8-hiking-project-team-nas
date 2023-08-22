<h1 class="py-4">Register</h1>

<form action="#" method="post">
    <div class="mb-3">
        <label for="firstname" class="form-label">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="firstnameHelp" placeholder="Your firstname..." required>
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="lastnameHelp" placeholder="Your lastname..." required>
    </div>
    <div class="mb-3">
        <label for="nickname" class="form-label">Nickname</label>
        <input type="text" class="form-control" name="nickname" id="nickname" aria-describedby="nicknameHelp" placeholder="Your nickname..." required>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email..." required>
        <div id=" emailHelp" class="form-text">We'll never share your email with anyone else.
        </div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Your password..." required>
    </div>

    <button type="submit" class="btn btn-secondary">Submit</button>
</form>

<?php if (isset($error_value)) : ?>
    <?php if ($error_value == "nodata") : ?>
        <p style="color: orangered;">Please, fill the field with your information.</p>
    <?php elseif ($error_value == "email") : ?>
        <p style="color: orangered;">This email is not valid.</p>

    <?php elseif ($error_value == "server") : ?>
        <p style="color: orangered;">Server response with an error. Try again later.</p>

    <?php elseif ($error_value == "exist") : ?>
        <p style="color: orangered;">This user does exist.</p>

    <?php endif; ?>
<?php endif; ?>