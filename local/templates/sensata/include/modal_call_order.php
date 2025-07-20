<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="modal-overlay" id="callOrderModal">
    <div class="modal-content">
        <button class="modal-close-btn" aria-label="Закрыть">&times;</button>
        <h2 class="modal-title">Свяжитесь с нами</h2>
        
        <div class="modal-contact-list">
            <div class="contact-item">
                <span class="contact-item__label">Отдел продаж г. Астана</span>
                <a href="tel:+77789793030" class="contact-item__phone">+7 778 979 30 30</a>
            </div>
            <div class="contact-item">
                <span class="contact-item__label">Отдел продаж г. Алматы</span>
                <a href="tel:+77005793030" class="contact-item__phone">+7 700 579 30 30</a>
            </div>
            <div class="contact-item">
                <span class="contact-item__label">Sensata Service</span>
                <a href="tel:+78000700909" class="contact-item__phone">+7 800 070 09 09</a>
            </div>
        </div>

        <p class="modal-separator-text">Или оставьте заявку и мы вам перезвоним:</p>
        
        <form action="#" class="modal-form" id="callOrderForm">
            <div class="form-group">
                <input type="text" name="userName" class="modal-input" placeholder="Ваше имя" required>
            </div>
            <div class="form-group">
                <input type="tel" name="userPhone" class="modal-input" placeholder="Номер телефона" required>
            </div>
            <button type="submit" class="custom-btn modal-submit-btn">Заказать звонок</button>
        </form>
        <p class="modal-description-small">Мы на связи в любое удобное для вас время.</p>
    </div>
</div>