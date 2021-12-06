/*================================================================================
	Item Name: Materialize - Material Design Kabala Admin Dashboard
================================================================================

NOTE:
-----
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */
const locale = $('meta[name="language"]').attr('content');

function deleteAlert(e, message) {
    if (confirm(message)) {
        e.parentElement.submit();
    }
}

$(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
});


$('.product_feature').on('select2:select', (e) => {
    const featureId = e.params.data.id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/'+locale+'/admin/feature-answers/' + featureId,
        method: 'GET',
        success: function (data) {
            let container = document.querySelector('#feature-row');
            let options = "";
            data.answer.forEach(item => {
                options += `
                       <option value="${item.id}">${item.available_language.length > 0 ? item.available_language[0].title : ""}</option>
                `;
            })
            let featureDropdown = `
            <div class="col s12 input-field" id="feature-${data.id}">

                <select name="answer[${data.id}][]"
                        class="product_answer select2 browser-default"
                        multiple="multiple">

                    ${options}

                </select>
                <label for="feature" class="">${data.available_language.length > 0 ? data.available_language[0].title : ""}</label>

            </div>`;
            $(container).append(featureDropdown);
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        }
    });
});


$('.product_feature').on('select2:unselect', (e) => {
    const featureId = e.params.data.id;
    let feature = document.querySelector(`#feature-${featureId}`);
    feature ? feature.remove() : "";
});
