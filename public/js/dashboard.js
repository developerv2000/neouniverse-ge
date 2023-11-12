// Initializing components on document ready
$(document).ready(function () {
    $(".selectize-singular").selectize({
        //options
    });

    $(".selectize-singular-linked").selectize({
        onChange(value) {
            window.location = value;
        }
    });

    $(".selectize-multiple").selectize({
        //options
    });

    // disable multiple click
    let singleModal = document.querySelector('#remove_item_modal');

    if (singleModal) {
        let singleModalForm = singleModal.querySelector('form');
        let singleModalSubmit = singleModalForm.querySelector('button');

        singleModalSubmit.onclick = function () {
            event.preventDefault();
            singleModalForm.submit();
            event.target.disabled = true;
        }
    }
});


// Add headers into Ajax Request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Enable Bootstraps 5 tooltips everywhere
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})


// Initialize Simditor WYSIWYG
Simditor.locale = 'ru-RU';
let editors = document.getElementsByClassName('simditor-wysiwyg');
let textareas = [];

for (i = 0; i < editors.length; i++) {
   textareas[i] = new Simditor({
      textarea: editors[i],
      toolbarFloatOffset: '60px',
      upload: {
        //  url: '/upload/simditor_photo',   //image upload url by server
        //  params: {
        //     folder: 'news' //used in store folder path
        //  },
        //  fileKey: 'simditor_photo', //name of input
        //  connectionCount: 10,
        //  leaveConfirm: 'Пожалуйста дождитесь окончания загрузки изображений на сервер! Вы уверены что хотите закрыть страницу?'
      },
    //   defaultImage: '/img/news/simditor/default/default.png', //default image thumb while uploading
    //  cleanPaste: true, //clear all styles while copy pasting,
      imageButton: 'upload',
      toolbar: ['title', 'bold', 'italic', 'underline', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'hr', '|', 'indent', 'outdent', 'alignment'] //image removed
   });
}


//toggle Aside Visibility
function toggle_aside() {
    let content = document.getElementById("content")
    content.classList.toggle("content--max");
}


// One modal is used for deleting any items in Main Form
// Change the value of input and show Single Item Remove Modal
function show_item_remove_modal(id) {
    let modal = new bootstrap.Modal(document.getElementById('remove_item_modal'));
    let input = document.getElementById("remove_item_modal_input");

    input.value = id;
    modal.show();
}


// Submit Main Form on Remove selected items modal button click
function submit_main_form() {
    document.getElementById("main_form").submit();
    event.target.disabled = true;
}


// Select or diselect all Main Forms checboxes
function select_all_checkboxes() {
    let main_form = document.getElementById("main_form")
    let checkboxes = main_form.getElementsByClassName("checkbox__input");
    let all_checked = true;

    for (chb of checkboxes) {
        if (!chb.checked) {
            all_checked = false;
            break;
        }
    }

    //select all items if not all of them selected
    if (!all_checked) {
        for (chb of checkboxes) {
            chb.checked = true;
        }
    }

    // else unselect them all
    else {
        for (chb of checkboxes) {
            chb.checked = false;
        }
    }
}


// initialize JSON Formatter
function getJson() {
    if (document.getElementById('json-input')) {
        try {
            return JSON.parse($('#json-input').val());
        } catch (ex) {
            console.log('Wrong JSON Format: ' + ex);
        }
    }
}

if ($('#json-display')) {
    let editor = new JsonEditor('#json-display', getJson());
    editor.load(getJson());
}

// validate json input before form submit
function validate_json_input(event) {
    let json_display = document.getElementById('json-display');
    let json_input = document.getElementById('json-input');

    if(isValidJson(json_display.textContent)) {
        json_input.value = json_display.textContent;
    } else {
        event.preventDefault();
        alert('Пожалуйста, исправьте ошибки прежде чем сохранить файл!');
    }
}

function isValidJson(str) {
    try {
        if (typeof str != 'string') return false;
        JSON.parse(str);
        return true;
    } catch (error) {
        return false;
    }
}
