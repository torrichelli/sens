document.addEventListener('DOMContentLoaded', function() {
    // Функциональность выбора языка
    const languageSelector = document.querySelector('.header-top .language-selector');
    if (languageSelector) {
        languageSelector.addEventListener('click', function() {
            console.log('Language selector clicked');
        });
    }

    // Функциональность кнопки "Показать еще"
    const showMoreBtn = document.querySelector('.show-more-btn');
    if (showMoreBtn) {
        showMoreBtn.addEventListener('click', function() {
            console.log('Show more clicked');
        });
    }

    // Функциональность кнопки "Подписаться" в футере
    const subscribeBtn = document.querySelector('.subscribe-main-btn');
    if (subscribeBtn) {
        subscribeBtn.addEventListener('click', function() {
            console.log('Subscribe button in footer clicked');
        });
    }
    
    // Кнопки и иконки-кнопки в Hero-секции
    const heroCardInteractiveElements = document.querySelectorAll(
        '.hero-2col-section .card-button, .hero-2col-section .card-button-icon-only'
    );
    heroCardInteractiveElements.forEach(element => {
        let clickableTarget = element.closest('a') || element;
        clickableTarget.addEventListener('click', function(e){
            const href = this.getAttribute('href');
            if (!href || href === '#') {
                e.preventDefault(); 
            }
            console.log('Hero card interactive element clicked:', element.textContent.trim() || 'icon');
        });
    });

    // Функциональность избранного (для десктопа)
    const favoritesLink = document.querySelector('.user-actions .favorites-link');
    if (favoritesLink) {
        favoritesLink.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Desktop Favorites clicked');
        });
    }

    // Функциональность кнопки входа (для десктопа)
    const loginBtnDesktop = document.querySelector('.user-actions .login-btn');
    if (loginBtnDesktop) {
        loginBtnDesktop.addEventListener('click', function() {
            console.log('Desktop Login clicked');
        });
    }     
     // --- ФУНКЦИОНАЛЬНОСТЬ ВЫПАДАЮЩЕГО СПИСКА ГОРОДОВ (ТЕПЕРЬ С ПРОВЕРКОЙ) ---
    const citySelectorBtn = document.getElementById('citySelectorBtn');
    const cityDropdown = document.getElementById('cityDropdown');

    // Эта проверка решает первую ошибку. Код внутри выполнится, только если оба элемента найдены.
    if (citySelectorBtn && cityDropdown) {
        citySelectorBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            this.classList.toggle('open');
            cityDropdown.classList.toggle('open');
        });

        document.addEventListener('click', function(event) {
            if (!citySelectorBtn.contains(event.target) && !cityDropdown.contains(event.target)) {
                citySelectorBtn.classList.remove('open');
                cityDropdown.classList.remove('open');
            }
        });
    }


    // Закрываем список, если клик был вне его
    document.addEventListener('click', function(event) {
        if (!citySelectorBtn.contains(event.target) && !cityDropdown.contains(event.target)) {
            citySelectorBtn.classList.remove('open');
            cityDropdown.classList.remove('open');
        }
    });


    // --- Функциональность бургер-меню ---
    const burgerButton = document.querySelector('.burger-menu-button');
    const mainNav = document.querySelector('#mainNav');

    if (burgerButton && mainNav) {
        burgerButton.addEventListener('click', function() {
            const isOpening = !mainNav.classList.contains('open');
            burgerButton.classList.toggle('open', isOpening);
            mainNav.classList.toggle('open', isOpening);
            burgerButton.setAttribute('aria-expanded', isOpening.toString());
            document.body.classList.toggle('body-no-scroll', isOpening);
        });
    }
    
    // --- Скрытие/показ шапки при скролле ---
    function initHeaderScroll() {
        const header = document.querySelector('.main-header');
        if (!header) return;
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll <= 0) {
                header.classList.remove('scroll-up', 'scroll-down');
                return;
            }
            if (currentScroll > lastScroll && !header.classList.contains('scroll-down')) {
                header.classList.add('scroll-down');
                header.classList.remove('scroll-up');
            } else if (currentScroll < lastScroll && header.classList.contains('scroll-down')) {
                header.classList.remove('scroll-down');
                header.classList.add('scroll-up');
            }
            lastScroll = currentScroll;
        });
    }
    initHeaderScroll();

    // --- MODAL "ORDER A CALL" LOGIC ---
    const callOrderModal = document.getElementById('callOrderModal');
    if (callOrderModal) {
        const openModalButtons = document.querySelectorAll('#headerTopCallBtn, .call-order-mobile, #ctaCardButton, #heroConsultationBtnCommercial');
        const modalCloseBtn = callOrderModal.querySelector('.modal-close-btn');
        const callOrderForm = document.getElementById('callOrderForm');

        const openModal = () => {
            callOrderModal.classList.add('visible');
            document.body.classList.add('body-no-scroll');
        };

        const closeModal = () => {
            callOrderModal.classList.remove('visible');
            document.body.classList.remove('body-no-scroll');
        };

        openModalButtons.forEach(button => {
            if (button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    openModal();
                });
            }
        });

        if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
        callOrderModal.addEventListener('click', (e) => e.target === callOrderModal && closeModal());
        document.addEventListener('keydown', (e) => e.key === 'Escape' && callOrderModal.classList.contains('visible') && closeModal());

        if (callOrderForm) {
            callOrderForm.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('Форма заказа звонка отправлена');
                alert('Спасибо за заявку! Мы скоро с вами свяжемся.');
                callOrderForm.reset();
                closeModal();
            });
        }
    }
    
    
    // --- НОВЫЙ БЛОК: ФИЛЬТРАЦИЯ НОВОСТЕЙ ---
    const newsFilterBtns = document.querySelectorAll('.news-filter-btn');
    const newsItems = document.querySelectorAll('.news-card-item');

    if (newsFilterBtns.length > 0 && newsItems.length > 0) {
        newsFilterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Управление активным классом для кнопок
                newsFilterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;

                // Фильтрация карточек
                newsItems.forEach(item => {
                    if (filter === 'all' || item.dataset.category === filter) {
                        item.style.display = 'block'; // Показываем элемент
                    } else {
                        item.style.display = 'none'; // Скрываем элемент
                    }
                });
            });
        });
    }
    // --- КОНЕЦ БЛОКА ФИЛЬТРАЦИИ НОВОСТЕЙ ---

    // --- Обработка форм ---
    const mortgageConsultationForm = document.getElementById('mortgageConsultationForm');
    if (mortgageConsultationForm) {
        mortgageConsultationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Заявка на консультацию по ипотеке отправлена');
            alert('Спасибо за вашу заявку! Мы свяжемся с вами.');
            mortgageConsultationForm.reset();
        });
    }
    
    const bottomVariantSelectionForm = document.getElementById('bottomVariantSelectionForm');
    if (bottomVariantSelectionForm) {
        bottomVariantSelectionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Нижняя форма "Мы подберем лучший вариант" отправлена');
            alert('Спасибо за вашу заявку! Наш менеджер скоро свяжется с вами.');
            bottomVariantSelectionForm.reset();
        });
    }
    function initHeroTimer() {
    const timerBlock = document.querySelector('.timer-block');
    if (!timerBlock) return;

    const endDate = new Date(timerBlock.dataset.endDate).getTime();

    const daysEl = timerBlock.querySelector('[data-timer="days"]');
    const hoursEl = timerBlock.querySelector('[data-timer="hours"]');
    const minutesEl = timerBlock.querySelector('[data-timer="minutes"]');
    const secondsEl = timerBlock.querySelector('[data-timer="seconds"]');

    const timerInterval = setInterval(function() {
        const now = new Date().getTime();
        const distance = endDate - now;

        if (distance < 0) {
            clearInterval(timerInterval);
            timerBlock.innerHTML = "<div class='timer-label'>Акция завершена</div>";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        daysEl.textContent = String(days).padStart(2, '0');
        hoursEl.textContent = String(hours).padStart(2, '0');
        minutesEl.textContent = String(minutes).padStart(2, '0');
        secondsEl.textContent = String(seconds).padStart(2, '0');

    }, 1000);
}

// Вызываем функцию инициализации таймера после загрузки DOM
initHeroTimer();

 // --- НОВЫЙ БЛОК: СКРОЛЛ К ФОРМЕ ОТКЛИКА ---
    const applyButtons = document.querySelectorAll('.apply-now-btn');
    const applyFormSection = document.getElementById('apply-form-section');
    const vacancyNameInput = document.querySelector('input[name="vacancy_name"]');

    if (applyButtons.length > 0 && applyFormSection && vacancyNameInput) {
        applyButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Получаем название вакансии из data-атрибута кнопки
                const vacancyName = this.dataset.vacancyName;
                
                // Подставляем название в скрытое поле формы
                vacancyNameInput.value = vacancyName;
                
                // Плавно прокручиваем к форме
                applyFormSection.scrollIntoView({ behavior: 'smooth' });
            });
        });
    }

    // Добавляем маску к новому полю телефона в форме отклика
    const applyPhoneInput = document.getElementById('apply-phone');
    if (applyPhoneInput) {
        const phoneMask = IMask(applyPhoneInput, {
            mask: '+{7} (000) 000-00-00'
        });
    }
    BX.ready(function() {
    // Обработка городского селектора
    var citySelector = BX('citySelectorBtn');
    var cityDropdown = BX('cityDropdown');
    
    if (citySelector && cityDropdown) {
        BX.bind(citySelector, 'click', function() {
            BX.toggleClass(cityDropdown, 'show');
        });
    }
});
});