<div class="container">
    <div class="container-wrapper">

        <div class="row pt-2">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <div class="card border-primary mb-3 text-center">
                    <div class="card-header text-primary" style="color: #000 !important;">
                        <img src="./info/pp/<?= $picture_url ?>" alt="" class="rounded-circle" style="max-width: 150px;">
                        <div class="container-wrapperr" style="max-width: 300px; margin-left: auto; margin-right: auto;">
                            <form action="./saveprofile.php" method="post">
                                <input type="hidden" class="form-control" value="<?= $userid ?>" style="color: #808080;" name="puserid"/>
                                <br />
                                <h3><?= $name ?></h3>
                                <input type="text" class="form-control" value="<?= $job ?>" style="color: #808080;" name="pjob" />
                                <br />
                                <div class="alert alert-secondary">
                                    <?= $strings['about'] ?>
                                </div>
                                <div class="input-group">
                                    <textarea class="form-control" style="height: 100px; resize: none;" name="pabout"><?= $about ?></textarea>
                                </div>
                                <br />
                                <br />
                                <div class="alert alert-secondary">
                                    <?= $strings['contact'] ?>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><?= $strings['email'] ?></span>
                                    </div>
                                    <input type="text" class="form-control" value="<?= $email ?>" name="pemail"/>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><?= $strings['phone'] ?></span>
                                    </div>
                                    <input type="text" class="form-control" value="<?= $phone ?>" name="pphone" />
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><?= $strings['location'] ?></span>
                                    </div>
                                    <input type="text" class="form-control" value="<?= $location ?>" name="plocation" />
                                </div>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            <?= $strings['save_button'] ?>
                        </button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
</div>