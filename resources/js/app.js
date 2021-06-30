require('./bootstrap');

$(document).ready(function () {
    let oldImages = $('#old_images').val();
    if (oldImages) {
        oldImages = JSON.parse(oldImages);
    }
    let imagedata = [];
    let getUrl = window.location;
    let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[0];
    if (oldImages && oldImages.length > 0) {
        oldImages.forEach((el, key) => {
            let directory = '';
            if (el.fileable_type === 'App\\Models\\User') {
                directory = 'user';
            }
            if (el.fileable_type === 'App\\Models\\Product') {
                directory = 'product';
            }
            if (el.fileable_type === 'App\\Models\\Category') {
                directory = 'category';
            }
            if (el.fileable_type === 'App\\Models\\Slider') {
                directory = 'slider';
            }
            if (el.fileable_type === 'App\\Models\\Answer') {
                directory = 'answer';
            }
            if (el.fileable_type === 'App\\Models\\Brand') {
                directory = 'brand';
            }
            if (el.fileable_type === 'App\\Models\\Page') {
                directory = 'page';
            }
            imagedata.push({
                id: el.id,
                src: `${baseUrl}storage/${directory}/${el.fileable_id}/${el.name}`
            })
        })
        $('.input-images').imageUploader({
            preloaded: imagedata,
            imagesInputName: 'images',
            preloadedInputName: 'old_images'
        });
    } else {
        $('.input-images').imageUploader();
    }
});

//
// document.addEventListener('DOMContentLoaded', () => {
//
//     $('.product_feature').on('select2:select', (e) => {
//
//         const featureId = e.params.data.id;
//
//         // Get feature Answers
//         const featureAnswersDropdownDiv = document.querySelector(".product_feature_answers");
//
//         if (!featureId) {
//             return;
//         }
//
//         fetch('answers/' + featureId).then((response) => {
//             return response.json();
//         }).then((jsonResponseAnswers) => {
//
//             if (jsonResponseAnswers.length === 0) {
//                 // featureAnswersDropdownDiv.innerHTML = "Feature Does not have answers.";
//                 return;
//             }
//
//             let childDropDownElement = document.createElement('div');
//             childDropDownElement.className = 'answer-dropdown-div';
//             childDropDownElement.setAttribute('style', 'margin-top:15px;paddin:3px');
//
//
//             let answerSelectHTML = `<select name="answers[]" class="select2 browser-default" >
//                                                             <option value="" disabled selected>Choose your option
//                                                             </option>`;
//
//             Object.keys(jsonResponseAnswers).forEach(key => {
//                 let answerId = jsonResponseAnswers[key].answer_id;
//                 let answerTitle = jsonResponseAnswers[key].answer_title;
//                 answerSelectHTML += `<option {{old("answer_id") ==  ${answerId}  ?   "selected":""}} value="${answerId}-${featureId}">${answerTitle}</option>`;
//             });
//
//             answerSelectHTML += "</select>";
//
//             childDropDownElement.innerHTML = answerSelectHTML;
//
//             featureAnswersDropdownDiv.appendChild(childDropDownElement);
//         }).catch((err) => {
//             console.log(err);
//         });
//     });
// });
