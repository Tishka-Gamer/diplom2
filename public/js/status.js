document.addEventListener("DOMContentLoaded", function() {
    const checkboxesContainer = document.getElementById('checkboxes-container');
    const table = document.getElementById('data-table');
    let statuses = []; // Переменная для хранения статусов

    // Функция для загрузки статусов с сервера
    function loadStatuses() {
        axios.get('/statuses')
            .then(response => {
                statuses = response.data; // Сохраняем статусы в переменную
                generateCheckboxes(statuses); // Передаем полученные статусы для генерации чекбоксов
            })
            .catch(error => {
                console.error('Error loading statuses:', error);
            });
    }

    // Функция для генерации чекбоксов на основе массива статусов
    function generateCheckboxes(statuses) {
        checkboxesContainer.innerHTML = statuses.map(status => `
            <label><input type="checkbox" class="status-filter" value="${status.id}"> ${status.name}</label>
        `).join('');
        loadData(); // После генерации чекбоксов загружаем данные и рендерим таблицу
    }

    // Функция для загрузки данных с сервера
    function loadData() {
        axios.get('/data')
            .then(response => {
                renderTable(response.data, statuses); // Передаем полученные данные и статусы для рендеринга таблицы
            })
            .catch(error => {
                console.error('Error loading data:', error);
            });
    }

    // Функция для рендеринга таблицы на основе данных и статусов
    function renderTable(data, statuses) {
        const tableRows = data.map(entry => `
            <tr>
                <th scope="row">${entry.id}</th>
                <td>${entry.adress}</td>
                <td>${entry.user}</td>
                <td>${entry.created_at}</td>
                <td>${entry.updated_at}</td>
                <td>
                ${entry.status_id == 3
                    ? 'Завершен'
                    : `
                        <select name="statusSelect" class="statusSelect" data-order-id="${entry.id}">
                            ${statuses.map(status => `
                                <option value="${status.id}" ${status.id == entry.status_id ? 'selected' : ''}>${status.name}</option>
                            `).join('')}
                        </select>
                    `
                }
                </td>
                <td>
                    <form action="{{Route('delord')}}">
                        <button name="id" type="submit" class="btn btn-primary " value="${entry.id}">del</button>
                    </form>
                </td>
            </tr>
        `).join('');

        table.innerHTML = `
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">адрес</th>
                    <th scope="col">пользователь</th>
                    <th scope="col">дата создания</th>
                    <th scope="col">дата выдачи</th>
                    <th scope="col">редактировать статус</th>
                    <th scope="col">удалить</th>
                </tr>
            </thead>
            <tbody>${tableRows}</tbody>
        `;

        // Добавляем обработчики событий после рендеринга таблицы
        addStatusChangeListeners();
    }

    // Функция для добавления обработчиков событий для изменения статусов
    function addStatusChangeListeners() {
        const csrfToken = document.getElementById('csrf-token').value;
        document.querySelectorAll('.statusSelect').forEach(function(selectElement) {
            selectElement.addEventListener('change', function(e) {
                const newStatus = this.value;
                const orderId = this.dataset.orderId;

                // Send an AJAX request to the server
                $.ajax({
                    url: '/changeStatus',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Передача CSRF-токена в заголовке запроса
                    },
                    data: {
                        order_id: orderId,
                        new_status: newStatus
                    },
                    success: function(response) {
                        console.log('Order status successfully changed');
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred while changing the order status:', error);
                    }
                });
            });
        });
    }

    // Обновление таблицы после изменения фильтров
    function updateTable() {
        const selectedStatuses = Array.from(document.querySelectorAll('.status-filter:checked'))
            .map(checkbox => checkbox.value);

        // Если выбраны фильтры, применяем их
        if (selectedStatuses.length > 0) {
            axios.get('/data')
                .then(response => {
                    const filteredData = response.data.filter(entry => selectedStatuses.includes(entry.status_id.toString()));
                    renderTable(filteredData, statuses);
                })
                .catch(error => {
                    console.error('Error filtering data:', error);
                });
        } else {
            loadData(); // Если не выбраны фильтры, загружаем данные и рендерим таблицу без фильтрации
        }
    }

    // Обработчик события изменения состояния чекбоксов
    checkboxesContainer.addEventListener('change', function(event) {
        if (event.target.classList.contains('status-filter')) {
            updateTable(); // При изменении чекбоксов обновляем таблицу
        }
    });

    // Инициализация
    loadStatuses(); // Загружаем статусы
});


// document.addEventListener("DOMContentLoaded", function() {
//     const checkboxesContainer = document.getElementById('checkboxes-container');
//     const table = document.getElementById('data-table');
//     let statuses = []; // Переменная для хранения статусов

//     // Функция для загрузки статусов с сервера
//     function loadStatuses() {
//         axios.get('/statuses')
//             .then(response => {
//                 statuses = response.data; // Сохраняем статусы в переменную
//                 generateCheckboxes(statuses); // Передаем полученные статусы для генерации чекбоксов
//             })
//             .catch(error => {
//                 console.error('Error loading statuses:', error);
//             });
//     }

//     // Функция для генерации чекбоксов на основе массива статусов
//     function generateCheckboxes(statuses) {
//         checkboxesContainer.innerHTML = statuses.map(status => `
//             <label><input type="checkbox" class="status-filter" value="${status.id}"> ${status.name}</label>
//         `).join('');
//         loadData(); // После генерации чекбоксов загружаем данные и рендерим таблицу
//     }

//     // Функция для загрузки данных с сервера
//     function loadData() {
//         axios.get('/data')
//             .then(response => {
//                 renderTable(response.data, statuses); // Передаем полученные данные и статусы для рендеринга таблицы
//             })
//             .catch(error => {
//                 console.error('Error loading data:', error);
//             });
//     }

//     // Функция для рендеринга таблицы на основе данных и статусов
//     function renderTable(data, statuses) {
//         const tableRows = data.map(entry => `
//             <tr>
//                 <th scope="row">${entry.id}</th>
//                 <td>${entry.adress}</td>
//                 <td>${entry.user}</td>
//                 <td>${entry.created_at}</td>
//                 <td>${entry.updated_at}</td>
//                 <td>
//                     <select name="statusSelect" class="statusSelect" data-order-id="${entry.id}">
//                         ${statuses.map(status => `
//                             <option value="${status.id}" ${status.id == entry.status_id ? 'selected' : ''}>${status.name}</option>
//                         `).join('')}
//                     </select>
//                 </td>
//                 <td>
//                     <form action="{{Route('delord')}}">
//                         <button name="id" type="submit" class="btn btn-primary " value="${entry.id}">del</button>
//                     </form>
//                 </td>
//             </tr>
//         `).join('');

//         table.innerHTML = `
//             <thead>
//                 <tr>
//                     <th scope="col">#</th>
//                     <th scope="col">адрес</th>
//                     <th scope="col">пользователь</th>
//                     <th scope="col">дата создания</th>
//                     <th scope="col">дата выдачи</th>
//                     <th scope="col">редактировать статус</th>
//                     <th scope="col">удалить</th>
//                 </tr>
//             </thead>
//             <tbody>${tableRows}</tbody>
//         `;
//     }

//     // Обновление таблицы после изменения фильтров
//     function updateTable() {
//         const selectedStatuses = Array.from(document.querySelectorAll('.status-filter:checked'))
//             .map(checkbox => checkbox.value);

//         // Если выбраны фильтры, применяем их
//         if (selectedStatuses.length > 0) {
//             axios.get('/data')
//                 .then(response => {
//                     const filteredData = response.data.filter(entry => selectedStatuses.includes(entry.status_id.toString()));
//                     renderTable(filteredData, statuses);
//                 })
//                 .catch(error => {
//                     console.error('Error filtering data:', error);
//                 });
//         } else {
//             loadData(); // Если не выбраны фильтры, загружаем данные и рендерим таблицу без фильтрации
//         }
//     }

//     // Обработчик события изменения состояния чекбоксов
//     checkboxesContainer.addEventListener('change', function(event) {
//         if (event.target.classList.contains('status-filter')) {
//             updateTable(); // При изменении чекбоксов обновляем таблицу
//         }
//     });

//     // Инициализация
//     loadStatuses(); // Загружаем статусы
// });

// const csrfToken = document.getElementById('csrf-token').value;
// document.querySelectorAll('.statusSelect').forEach(function(selectElement) {
//     selectElement.addEventListener('change', function(e) {
//         const newStatus = this.value;
//         const orderId = this.dataset.orderId;

//     // Send an AJAX request to the server
//     $.ajax({
//         url: '/changeStatus',
//         type: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': csrfToken // Передача CSRF-токена в заголовке запроса
//         },
//         data: {
//             order_id: orderId,
//             new_status: newStatus
//         },
//         success: function(response) {
//             console.log('Order status successfully changed');
//         },
//         error: function(xhr, status, error) {
//             console.error('An error occurred while changing the order status:', error);
//         }
//     });
// })});
