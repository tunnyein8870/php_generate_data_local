<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>
<div class="container navbar d-block">
    <h2>Generate Fake Data</h2>
    <h5>Instruction:</h5>
    <div>
        <div>
                <?php echo $dir = __DIR__ . "/db_handle/host_db.php" ?>
            <!-- <form action="db_handle/host_db.php" method="POST"> -->
            <form action="db_handle/host_db.php" method="POST">
                <div class="d-block">
                    <label class="mt-2" for="db">Enter Details</label>
                    <input type="text" class="d-block ms-3 my-2" name="host" value=""
                        placeholder="Public IP (e.g. 127.0.0.1)" required>
                    <p class="d-flex ms-3"><a href="https://www.whatismyip.com/">Check IP >></a></p>
                    <label class="mt-2" for="db">Enter Database Name</label>
                    <input type="text" class="d-block ms-3 my-2" name="db" value="" placeholder="Database (mysql)"
                        required>
                </div>
                <input type="text" class="d-block ms-3 my-2" name="user" value="" placeholder="Username (root)"
                    required>
                <input type="text" class="d-block ms-3 my-2" name="pass" value="" placeholder="Password">
                <div class="d-flex">
                    <label class="" for="db">Enter Table Name</label>
                    <input type="text" class="d-block ms-5 mb-2" name="table" placeholder="Table Name" required>
                </div>
                <label class="me-5">Enter Number of columns.</label>
                <input type="number" class="d-inline-flex ms-5" oninput="addInputFields()" name="count" min="1"
                    max="15">
                <br><br>
                <div>
                    <h5>Availabe Fields</h5>
                    <div>
                        <span>name, </span>
                        <span>firstName,</span>
                        <span>lastName,</span>
                        <span>age,</span>
                        <span>gender,</span>
                        <span>city</span>
                        <span>email/mail,</span>
                        <span>password/pass,</span>
                        <span>phone/ph,</span>
                        <span>address,</span>
                    </div>
                    <div>
                        <span>startdate,</span>
                        <span>enddate,</span>
                        <span>quantity/qty,</span>
                        <span>number/num,</span>
                        <span>price,</span>
                        <span>bankacc,</span>
                        <span>company,</span>
                        <span>city,</span>
                        <span>description/des,</span>
                        <span>state,</span>
                        <span>country</span>
                    </div>
                    <div id="inputFields" class="mt-3"></div>
                    <label class="mt-3 me-5">Enter Number of records.</label>
                    <input type="number" class="ms-5" name="times" min="1" max="100">
                    <input type="submit" class="d-block mt-2">
            </form>
            <?php if (isset($_GET['table_success'])) { ?>
                <span class="text-danger d-inline-flex">Table Created.</span>
            <?php } ?>
        </div>
    </div>
    <script src="js/dynamic_form.js"></script>
</div>

</html>