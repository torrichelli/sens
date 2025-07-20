document.addEventListener('DOMContentLoaded', function() {

    // --- ЛОГИКА ДЛЯ СЛАЙДЕРА "ЧТО РЯДОМ" ---
    const nearbyCarouselElement = document.getElementById('nearbyCarousel');
    
    if (nearbyCarouselElement) {
        const carousel = new bootstrap.Carousel(nearbyCarouselElement, {
            interval: false,
            wrap: true
        });

        const paginationElement = document.querySelector('.carousel-pagination');
        const progressBarElement = document.querySelector('.progress-bar-custom');
        const totalItems = nearbyCarouselElement.querySelectorAll('.carousel-item').length;

        const updateCarouselControls = (e) => {
            const currentSlideIndex = e.to;
            if (paginationElement) {
                paginationElement.textContent = `${currentSlideIndex + 1} / ${totalItems}`;
            }
            if (progressBarElement) {
                const progressPercentage = ((currentSlideIndex + 1) / totalItems) * 100;
                progressBarElement.style.width = `${progressPercentage}%`;
            }
        };

        const firstItem = nearbyCarouselElement.querySelector('.carousel-item.active');
        if (firstItem) {
            const firstItemIndex = Array.from(nearbyCarouselElement.querySelectorAll('.carousel-item')).indexOf(firstItem);
            updateCarouselControls({ to: firstItemIndex });
        }
        
        nearbyCarouselElement.addEventListener('slid.bs.carousel', updateCarouselControls);
    }

    // --- ЛОГИКА ДЛЯ СЛАЙДЕРА "ПЛАНИРОВКИ" (НОВАЯ ВЕРСИЯ) ---
    const layoutsData = [
        { id: 1, rooms: '1', area: 45.5, price: '15 200 000', image: 'https://via.placeholder.com/600x700/ffffff/333?text=План+1-комн.(1)' },
        { id: 2, rooms: '1', area: 48.2, price: '16 100 000', image: 'https://via.placeholder.com/600x700/ffffff/333?text=План+1-комн.(2)' },
        { id: 3, rooms: '2', area: 68.1, price: '22 500 000', image: 'https://via.placeholder.com/600x700/ffffff/333?text=План+2-комн.(1)' },
        { id: 4, rooms: '2', area: 72.4, price: '24 000 000', image: 'https://via.placeholder.com/600x700/ffffff/333?text=План+2-комн.(2)' },
        { id: 5, rooms: '3', area: 89.9, price: '29 800 000', image: 'https://via.placeholder.com/600x700/ffffff/333?text=План+3-комн.(1)' },
        { id: 6, rooms: '3', area: 95.0, price: '31 200 000', image: 'https://via.placeholder.com/600x700/ffffff/333?text=План+3-комн.(2)' },
        { id: 7, rooms: '4', area: 116.8, price: '38 000 000', image: 'https://via.placeholder.com/600x700/ffffff/333?text=План+4-комн.' },
    ];

    const sliderContainer = document.querySelector('.layouts-v2-section');
    if (sliderContainer) {
        const sliderView = sliderContainer.querySelector('.slider-main-view');
        const prevBtn = sliderContainer.querySelector('.prev-layout');
        const nextBtn = sliderContainer.querySelector('.next-layout');
        const paginationEl = sliderContainer.querySelector('.slider-pagination');
        const layoutFilterButtons = sliderContainer.querySelectorAll('.layouts-v2-filters .btn-filter');

        let currentLayouts = [...layoutsData];
        let currentIndex = 0;

        function renderSlider() {
            if (!sliderView || !paginationEl) return;

            if (currentLayouts.length === 0) {
                sliderView.innerHTML = `<div class="layout-slide-item" style="height: 400px; display: flex; align-items: center; justify-content: center;"><p>Нет планировок по вашему запросу</p></div>`;
                paginationEl.textContent = '0 из 0';
                return;
            }

            if (currentIndex >= currentLayouts.length) currentIndex = 0;
            if (currentIndex < 0) currentIndex = currentLayouts.length - 1;

            const layout = currentLayouts[currentIndex];
            sliderView.innerHTML = `
                <div class="layout-slide-item">
                    <img src="${layout.image}" alt="План квартиры ${layout.rooms}-комнатной">
                </div>
            `;
            paginationEl.textContent = `${currentIndex + 1} из ${currentLayouts.length}`;
        }

        if(nextBtn) {
            nextBtn.addEventListener('click', () => {
                currentIndex++;
                if (currentIndex >= currentLayouts.length) {
                    currentIndex = 0;
                }
                renderSlider();
            });
        }

        if(prevBtn){
            prevBtn.addEventListener('click', () => {
                currentIndex--;
                if (currentIndex < 0) {
                    currentIndex = currentLayouts.length - 1;
                }
                renderSlider();
            });
        }

        if(layoutFilterButtons.length > 0) {
            layoutFilterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    layoutFilterButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    const filter = button.dataset.filter;
                    if (filter === 'all') {
                        currentLayouts = [...layoutsData];
                    } else {
                        currentLayouts = layoutsData.filter(layout => layout.rooms === filter);
                    }

                    currentIndex = 0;
                    renderSlider();
                });
            });
        }
        
        renderSlider();
    }

    // --- ЛОГИКА ДЛЯ МОДАЛЬНОГО ОКНА "ОСОБЕННОСТИ" ---
    const featureModalEl = document.getElementById('featureDetailModal');
    if (featureModalEl) {
        featureModalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const title = button.getAttribute('data-title');
            const text = button.getAttribute('data-text');
            const imageUrl = button.getAttribute('data-image');

            const modalTitle = featureModalEl.querySelector('.feature-modal-title');
            const modalText = featureModalEl.querySelector('.feature-modal-text');
            const modalImage = featureModalEl.querySelector('.feature-modal-image');

            if(modalTitle) modalTitle.textContent = title;
            if(modalText) modalText.innerHTML = text;
            if(modalImage) {
                modalImage.src = imageUrl;
                modalImage.alt = title;
            }
        });
    }

    // --- ИНИЦИАЛИЗАЦИЯ ПОДСКАЗОК BOOTSTRAP ДЛЯ ХОТСПОТОВ ---
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));


    // --- НОВЫЙ БЛОК: ОБНОВЛЕНИЕ ССЫЛКИ ДЛЯ КНОПКИ УВЕЛИЧЕНИЯ В СЛАЙДЕРАХ ---
    function setupDynamicLightbox(carouselId) {
        const carouselElement = document.getElementById(carouselId);
        if (!carouselElement) return;

        const expandButton = carouselElement.querySelector('.project-gallery-expand');
        if (!expandButton) return;

        function updateLightboxHref() {
            const activeItem = carouselElement.querySelector('.carousel-item.active');
            if (activeItem) {
                const activeImage = activeItem.querySelector('img');
                if (activeImage) {
                    expandButton.href = activeImage.src;
                }
            }
        }
        
        // Обновляем ссылку при смене слайда
        carouselElement.addEventListener('slid.bs.carousel', updateLightboxHref);
        
        // Устанавливаем правильную ссылку при загрузке страницы
        updateLightboxHref();
    }
    
      // --- НОВЫЙ ДИНАМИЧЕСКИЙ СЛАЙДЕР ПЛАНИРОВОК С ФИЛЬТРАЦИЕЙ ---
    const layoutsSection = document.getElementById('layouts');
    if (layoutsSection) {
        const carouselEl = layoutsSection.querySelector('#layoutsCarousel');
        const carouselInner = carouselEl.querySelector('.carousel-inner');
        const allItems = Array.from(carouselInner.querySelectorAll('.carousel-item')); // Сохраняем все слайды
        
        const areaText = layoutsSection.querySelector('#layout-area-text');
        const priceText = layoutsSection.querySelector('#layout-price-text');
        const paginationText = layoutsSection.querySelector('#layout-pagination');
        const filterButtons = layoutsSection.querySelectorAll('.layouts-v2-filters .btn-filter');

        let currentCarouselInstance;
        let currentVisibleItems = [];

        function updateLayoutInfo() {
            if (!currentVisibleItems.length) {
                if(areaText) areaText.textContent = 'Нет планировок по вашему запросу';
                if(priceText) priceText.textContent = '';
                if(paginationText) paginationText.textContent = '0 из 0';
                return;
            };

            const activeItem = carouselInner.querySelector('.carousel-item.active');
            if (!activeItem) return;

            const activeIndex = currentVisibleItems.indexOf(activeItem);

            const area = activeItem.dataset.area;
            const price = activeItem.dataset.price;
            
            if(areaText) areaText.textContent = `Все до ${area} м²`;
            if(priceText) priceText.textContent = `от ${price} ₸`;
            if(paginationText) paginationText.textContent = `${activeIndex + 1} из ${currentVisibleItems.length}`;
        }
        
        function setupCarousel(items) {
            // Уничтожаем предыдущую карусель, если она была
            if (currentCarouselInstance) {
                currentCarouselInstance.dispose();
            }
            
            // Очищаем и заполняем новыми элементами
            carouselInner.innerHTML = '';
            currentVisibleItems = items;

            if (items.length > 0) {
                 // Убираем active со всех и ставим на первый
                items.forEach((item, index) => {
                    item.classList.remove('active');
                    if(index === 0) {
                        item.classList.add('active');
                    }
                    carouselInner.appendChild(item);
                });
                carouselEl.classList.remove('d-none');
            } else {
                 carouselEl.classList.add('d-none');
            }

            // Создаем новый экземпляр карусели и добавляем слушатель
            currentCarouselInstance = new bootstrap.Carousel(carouselEl, {
                interval: false, // Отключаем автопрокрутку
                wrap: true,
            });
            carouselEl.addEventListener('slid.bs.carousel', updateLayoutInfo);
            
            // Обновляем информацию
            updateLayoutInfo();
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                
                let filteredItems;
                if (filter === 'all') {
                    filteredItems = allItems;
                } else {
                    filteredItems = allItems.filter(item => {
                        const rooms = item.dataset.rooms;
                        if (filter === '4') {
                            return parseInt(rooms) >= 4;
                        }
                        return rooms === filter;
                    });
                }
                
                setupCarousel(filteredItems);
            });
        });

        // Первоначальная настройка карусели
        setupCarousel(allItems);
    }

    // Применяем эту функцию ко всем нашим галереям
    setupDynamicLightbox('projectGallery');
    setupDynamicLightbox('leisureCarousel');
    setupDynamicLightbox('atmosphereCarousel');

    // --- ЛОГИКА ДЛЯ СЛАЙДЕРА ПЛАНИРОВОК ---
    const layoutsSection1 = document.getElementById('layouts');
    if (layoutsSection1) {
        // ... Код для слайдера планировок остается без изменений ...
    }

    // --- ЛОГИКА ДЛЯ ПОПАПА "ХОД СТРОИТЕЛЬСТВА" С AJAX ---
    const photoReportModalEl = document.getElementById('photoReportModal');
    if (photoReportModalEl) {
        photoReportModalEl.addEventListener('show.bs.modal', function(event) {
            // Кнопка, которая вызвала модальное окно
            const triggerButton = event.relatedTarget;
            const objectId = triggerButton.dataset.objectId;

            if (!objectId) {
                console.error('Object ID not found on trigger button');
                return;
            }

            const filtersContainer = photoReportModalEl.querySelector('#report-filters');
            const carouselInner = photoReportModalEl.querySelector('#photoReportCarousel .carousel-inner');
            const reportTitleEl = photoReportModalEl.querySelector('#report-title');
            
            // Показываем индикатор загрузки
            filtersContainer.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>';
            carouselInner.innerHTML = '<div class="carousel-item active h-100 d-flex justify-content-center align-items-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';

            const ajaxPath = '/local/templates/sensata/components/bitrix/news/real_estate/ajax.php';

            fetch(`${ajaxPath}?objectId=${objectId}`)
                .then(response => {
                    if (!response.ok) { throw new Error('Network response was not ok'); }
                    return response.json();
                })
                .then(data => {
                    if (data.error || data.length === 0) {
                        filtersContainer.innerHTML = '';
                        reportTitleEl.textContent = 'Отчетов не найдено';
                        carouselInner.innerHTML = '<div class="carousel-item active h-100 d-flex justify-content-center align-items-center"><p>Фотографии не найдены.</p></div>';
                        return;
                    }

                    renderFilters(data);
                    renderGallery(data[0].photos);
                    reportTitleEl.textContent = `Отчет за ${data[0].month} ${data[0].year}`;

                    filtersContainer.querySelectorAll('a').forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            const reportId = parseInt(this.dataset.reportId);
                            const selectedReport = data.find(report => report.id === reportId);
                            
                            if (selectedReport) {
                                renderGallery(selectedReport.photos);
                                reportTitleEl.textContent = `Отчет за ${selectedReport.month} ${selectedReport.year}`;
                                filtersContainer.querySelectorAll('a').forEach(a => a.classList.remove('active'));
                                this.classList.add('active');
                            }
                        });
                    });
                })
                .catch(error => {
                    console.error('Error fetching construction progress:', error);
                    reportTitleEl.textContent = 'Ошибка загрузки';
                    filtersContainer.innerHTML = '';
                });

            function renderFilters(reports) {
                let html = '<ul>';
                reports.forEach((report, index) => {
                    html += `<li><a href="#" class="${index === 0 ? 'active' : ''}" data-report-id="${report.id}">${report.month} ${report.year}</a></li>`;
                });
                html += '</ul>';
                filtersContainer.innerHTML = html;
            }

            function renderGallery(photos) {
                let html = '';
                if(photos && photos.length > 0) {
                    photos.forEach((photo, index) => {
                        html += `
                            <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                <img src="${photo.src}" class="d-block" style="width:100%; height: 80vh; object-fit: contain;" alt="${photo.description || ''}">
                            </div>
                        `;
                    });
                } else {
                    html = '<div class="carousel-item active h-100 d-flex justify-content-center align-items-center"><p>В этом отчете нет фотографий.</p></div>';
                }
                carouselInner.innerHTML = html;
            }
        });
    }
     // --- НОВЫЙ БЛОК: ФОРМА КОНТАКТОВ ---
    const contactForm = document.getElementById('contact-form-main');
    if (contactForm) {
        const phoneInput = contactForm.querySelector('#user-phone');
        const nameInput = contactForm.querySelector('#user-name');
        const submitButton = contactForm.querySelector('.btn-call-submit');

        // 1. Применяем маску к телефону
        const phoneMask = IMask(phoneInput, {
            mask: '+{7} (000) 000-00-00'
        });

        // 2. Валидация для активации кнопки
        function validateForm() {
            const isNameValid = nameInput.value.trim().length > 1; // Имя должно быть длиннее 1 символа
            const isPhoneValid = phoneMask.masked.isComplete; // Маска телефона должна быть заполнена

            if (isNameValid && isPhoneValid) {
                submitButton.disabled = false;
                submitButton.classList.add('active'); // Добавляем класс для стилизации активной кнопки
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('active');
            }
        }

        nameInput.addEventListener('input', validateForm);
        phoneInput.addEventListener('input', validateForm);
    }
});