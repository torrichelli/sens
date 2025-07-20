<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?// --- HTML-КАРКАС ДЛЯ ПОПАПА (разместить в конце файла) --- ?>
<div class="modal fade" id="photoReportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                 <span class="modal-logo"><img src="<?php echo SITE_TEMPLATE_PATH ?>/images/logo_v2.png" alt="" /></span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <div class="row h-100">
                    <div class="col-md-3">
                        <h2 id="report-title" class="mb-4">Отчеты</h2>
                        <div id="report-filters">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div id="photoReportCarousel" class="carousel slide h-100">
                            <div class="carousel-inner h-100">
                                <div class="carousel-item active h-100 d-flex justify-content-center align-items-center">
                                    <p>Выберите отчет для просмотра</p>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#photoReportCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#photoReportCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>