<div class="wrap">
    <div class="header">
        <div class="logo">
            <img src="<?php echo DEVAPPS_CERTIFICATE_GENERATOR_URL . "admin/images/devapps.png";?>" alt="DevApps Consultoria e Desenvolvimento" class="img-fluid">
        </div>
        <div class="contact">
            <a href="https://devapps.com.br/#contact" target="_blank">Ajuda | Suporte | Feedback</a>
        </div>
    </div>
    <div class="header-title">
        <h4 class="text-center text-light">Siga os passos para gerar seus certificados</h4>
    </div>
    <div class="header-nav">
        <div class="tabs">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-model-tab" data-toggle="pill" data-target="#pills-models" type="button" role="tab" aria-controls="pills-models" aria-selected="true">
                        <?php echo sprintf(__("%s - Modelo de Certificado", 'gerador-de-certificados-devapps'), "1º"); ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-person-tab" data-toggle="pill" data-target="#pills-person" type="button" role="tab" aria-controls="pills-person" aria-selected="false" disabled>
                        <?php echo sprintf(__("%s - Dados dos Participantes", 'gerador-de-certificados-devapps'), "2º"); ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-course-tab" data-toggle="pill" data-target="#pills-course" type="button" role="tab" aria-controls="pills-curse" aria-selected="false" disabled>
                        <?php echo sprintf(__("%s - Dados do Curso", 'gerador-de-certificados-devapps'), "3º"); ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-generate-tab" data-toggle="pill" data-target="#pills-generate" type="button" role="tab" aria-controls="pills-generate" aria-selected="false" disabled>
                        <?php echo sprintf(__("%s - Gerar os Certificados", 'gerador-de-certificados-devapps'), "4º"); ?>
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-models" role="tabpanel" aria-labelledby="pills-models-tab">
                        <?php
                            devapps_get_view('tabs/models', true);
                        ?>
                    </div>
                    <div class="tab-pane fade" id="pills-person" role="tabpanel" aria-labelledby="pills-person-tab">
                        <?php
                            devapps_get_view('tabs/person', true);
                        ?>
                    </div>
                    <div class="tab-pane fade" id="pills-course" role="tabpanel" aria-labelledby="pills-course-tab">
                        <?php
                            devapps_get_view('tabs/course', true);
                        ?>
                    </div>
                    <div class="tab-pane fade" id="pills-generate" role="tabpanel" aria-labelledby="pills-generate-tab">
                        <?php
                            devapps_get_view('tabs/generate', true);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
