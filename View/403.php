<!-- ======= 403 ======= -->
<div class="col-12">
    <div class="d-flex justify-content-center align-items-center">
        <div class="d-flex justify-content-start align-items-center">
            <h1 class="display-1 text-<?= $this->getColor() ?> me-3"><?= $this->getRoute() ?></h1>
            <div style="max-width: 500px">
                <h3><i class="bi bi-<?= $this->getIcon() ?> fs-1 text-<?= $this->getColor() ?> me-2"></i><?= $this->getLabel() ?></h3>
                <p>
                <?= $this->Locale->get("You do not have permission to access this page."); ?>
                    <?php if($this->isAuthenticated()){ ?>
                        <?= $this->Locale->get("Meanwhile, you may"); ?> <a href="/"><?= $this->Locale->get("go back"); ?></a> <?= $this->Locale->get("or try using the search form."); ?>
                    <?php } ?>
                </p>
                <?php if($this->isAuthenticated()){ ?>
                    <form action="?p=searchResults" method="post" autocomplete="on" novalidate>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control search" placeholder="<?= $this->Locale->get("Search"); ?>..." value="<?php if(isset($_POST['search'])){ echo $_POST['search']; } ?>">
                            <button type="submit" name="submit" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- ======= End 403 ======= -->
