<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

        </main>

        <footer class="main-footer">
            <div class="container-fluid header-container">
                <div class="subscription-section">
                    <div class="subscription-card">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/footer_subscribe.php",
                                "EDIT_TEMPLATE" => ""
                            )
                        );?>
                    </div>
                </div>

                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Проекты</h4>
                        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer_menu", 
	[
		"ROOT_MENU_TYPE" => "footer_projects",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => "footer_menu",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => [
		],
		"CHILD_MENU_TYPE" => "footer",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	],
	false
);?>
                    </div>
                     <div class="footer-column">
                        <h4>Покупателям</h4>
                        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer_menu", 
	[
		"ROOT_MENU_TYPE" => "footer_buyers",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => "footer_menu",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => [
		],
		"CHILD_MENU_TYPE" => "footer",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	],
	false
);?>
                    </div>
                     <div class="footer-column">
                        <h4>О компании</h4>
                        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer_menu", 
	[
		"ROOT_MENU_TYPE" => "footer_about",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => "footer_menu",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => [
		],
		"CHILD_MENU_TYPE" => "footer",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	],
	false
);?>
                    </div>
                     <div class="footer-column">
                        <h4>Сервис</h4>
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", Array(
                            "ROOT_MENU_TYPE" => "footer_service", 
                            "MAX_LEVEL" => "1", 
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600"
                            ), false
                        );?>
                    </div>
                     <div class="footer-column">
                        <h4>Пресс-центр</h4>
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", Array(
                            "ROOT_MENU_TYPE" => "footer_press", 
                            "MAX_LEVEL" => "1", 
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600"
                            ), false
                        );?>
                    </div>
                    <div class="footer-column">
                        <h4>Партнерам</h4>
                         <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", Array(
                            "ROOT_MENU_TYPE" => "footer_partners", 
                            "MAX_LEVEL" => "1", 
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600"
                            ), false
                        );?>
                    </div>
                </div>

                <div class="footer-social-contact">
                    <div class="footer-social-links">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/footer_socials.php",
                                "EDIT_TEMPLATE" => ""
                            )
                        );?>
                    </div>
                </div>

                <div class="footer-bottom">
                    <p class="copyright">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/footer_copyright.php",
                                "EDIT_TEMPLATE" => ""
                            )
                        );?>
                    </p>
                    <p class="legal-text">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/footer_legal.php",
                                "EDIT_TEMPLATE" => ""
                            )
                        );?>
                    </p>
                    <p class="credits">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/footer_credits.php",
                                "EDIT_TEMPLATE" => ""
                            )
                        );?>
                    </p>
                </div>
            </div>
        </footer>
    </div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include", "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/modal_call_order.php"
        )
    );?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include", "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/modal_featured.php"
        )
    );?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include", "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include/modal_stroitel.php"
        )
    );?>
</body>
</html>