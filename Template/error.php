<?php
$this->Configurator->add('themes');
$this->Configurator->add('defaults');
$this->Configurator->add('identity');
if($this->Configurator->get('identity','brand') === null){
    $this->Configurator->set('identity','brand',$this->Configurator->get('defaults','brand'));
    $this->Configurator->set('identity','gradient-start',$this->Configurator->get('defaults','gradient-start'));
    $this->Configurator->set('identity','gradient-end',$this->Configurator->get('defaults','gradient-end'));
}
?>
<!doctype html>
<html lang="en" data-bs-theme="light" data-theme="<?= $this->Configurator->get('identity','theme')?>" class="h-100 w-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->getLabel() ?></title>

        <!-- ======= Fav Icons ======= -->
        <link rel="icon" href="/img/favicon.ico">
        <link rel="icon" sizes="16x16" href="/img/favicon-16.png">
        <link rel="icon" sizes="32x32" href="/img/favicon-32.png">
        <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
        <link rel="manifest" href="/img/site.webmanifest">

        <!-- ======= Load Global CSS ======= -->
        <?= $this->css(); ?>

        <!-- ======= Load Themes CSS ======= -->
        <?php foreach($this->Configurator->get('themes','themes') as $name => $theme){ ?>
            <link rel="stylesheet" href="/css/themes/<?= $name ?>/styles.css" data-theme="<?= $name ?>" disabled>
        <?php } ?>

        <!-- ======= CSRF_TOKEN ======= -->
        <script>
            const CSRF_TOKEN = "<?php echo $this->CSRF->token(); ?>";
        </script>

        <!-- ======= Load Global JS ======= -->
        <?= $this->js(); ?>

        <!-- ======= Testing Styles ======= -->
        <style>
            body {
                /* Remove background image */
                background-image: none !important;
                background-color: none !important;
                /* Glass */
                background: linear-gradient(45deg, <?php echo $this->Configurator->get('identity','gradient-start') ?>, <?php echo $this->Configurator->get('identity','gradient-end') ?>)!important;
                background-attachment: fixed !important;
            }
            #sidebar {
                width: 300px;
            }
            #sidebar.collapsing {
                width: 0px;
            }
            #content {
                margin-left: 300px;
                width: calc(100vw - 300px);
                transition: 300ms ease;
            }
        </style>
    </head>
    <body data-bs-spy="scroll" data-bs-target="#main-nav" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0" class="h-100 w-100">

        <!-- ======= Controls ======= -->
        <div id="controls" class="d-flex position-fixed bottom-0 end-0 mb-3 me-3" style="z-index:1041;">

            <!-- ======= Back to Top ======= -->
            <div class="mx-1 back-to-top">
                <a href="#" class="d-flex align-items-center justify-content-center btn btn-primary py-2">
                    <i class="bi bi-arrow-up my-1" style="font-size:1em;"></i>
                </a>
            </div>
            <!-- ======= End Back to Top ======= -->

        </div>
        <!-- ======= End Controls ======= -->

        <!-- ======= Main ======= -->
        <main class="h-100 w-100 d-flex justify-content-center align-items-center">

            <div class="card card-body rounded-0">
                <div class="d-flex justify-content-center align-items-center">
                    <!--- Load View --->
                    <?php require $this->getViewFile(); ?>
                </div>
            </div>
        </main>
        <!-- ======= End Main ======= -->

        <!-- ======= Panel.JS ======= -->
        <script src="/js/panel.js"></script>

        <!-- ======= Cookie Compliance ======= -->
        <?= $this->Auth->Compliance->form() ?>
        <!-- ======= End Cookie Compliance ======= -->
    </body>
</html>
