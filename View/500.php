<!-- ======= 500 ======= -->
<div class="col-12">
    <div class="d-flex justify-content-center align-items-center">
        <div class="d-flex justify-content-start align-items-center">
            <h1 class="display-1 text-<?= $this->getColor() ?> me-3"><?= $this->getRoute() ?></h1>
            <div style="max-width: 500px">
                <h3><i class="bi bi-<?= $this->getIcon() ?> fs-1 text-<?= $this->getColor() ?> me-2"></i><?= $this->getLabel() ?></h3>
                <p>
                <?= $this->Locale->get("The server encountered an internal error or misconfiguration and was unable to complete your request."); ?>
                    <?php if($this->isAuthenticated()){ ?>
                        <?= $this->Locale->get("Please try again later or"); ?> <a href="/contact-support"><?= $this->Locale->get("contact support"); ?></a> <?= $this->Locale->get("if the issue persists."); ?>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- ======= End 500 ======= -->
