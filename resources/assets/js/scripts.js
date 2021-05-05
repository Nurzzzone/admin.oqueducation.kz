(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

    $(document).ready(() => {
        readQuestionUrl();
        readAnswerUrl();
        readTasksUrl();
    
        let questionObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                setQuestionsIdentifier();
                readQuestionUrl();
            });    
        });
    
        questionObserver.observe($('div[data-repeater-list="questions"]')[0], {
            childList: true, 
        });
    
        let answerObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                setAnswersIdentifier();
                readAnswerUrl();
            });    
        });
    
        answerObserver.observe($('div[data-repeater-list="answers"]')[0], {
            childList: true, 
        });
    
        let taskObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                setTasksIdentifier();
                readTasksUrl();
            });    
        });
    
        taskObserver.observe($('div[data-repeater-list="tasks"]')[0], {
            childList: true, 
        });
    
        function setQuestionsIdentifier() {
            $('.question').each((index, element) => {
                let imgInput =  $(element).find('.questionImageUpload');
                let imgLabels = $(element).find('label[for="image"]');
                
                 $(imgInput).attr('id', index + 'questionImage');
                 $(imgLabels).each(function(i, e) {
                     $(e).attr('for', index + 'questionImage');
                 });
            });
        }
    
        function setAnswersIdentifier() {
            $('.answer').each((index, element) => {
                let imgInput =  $(element).find('.answerImageUpload');
                let imgLabels = $(element).find('label[for="answer-image"]');
                
                 $(imgInput).attr('id', index + 'answerImage');
                 $(imgLabels).each(function(i, e) {
                     $(e).attr('for', index + 'answerImage');
                 });
            });
        }
    
        function setTasksIdentifier() {
            $('.task').each((index, element) => {
                let imgInput =  $(element).find('.taskImageUpload');
                let imgLabels = $(element).find('label[for="task-image"]');
                
                 $(imgInput).attr('id', index + 'taskImage');
                 $(imgLabels).each(function(i, e) {
                     $(e).attr('for', index + 'taskImage');
                 });
            });
        }
    
        function readQuestionUrl() {
            $('.question').each((index, element) => {
                let imgInput =  $(element).find('.questionImageUpload');
         
                 $(imgInput).change(function() {
                     if (this.files && this.files[0]) {
                         let reader = new FileReader();
                         if (!$(element).find('.quesitonImage-preview').length) {
                             let imageContainer = `<div style='background-image: url();' class='quesitonImage-preview users-avatar-shadow' width="240" height="240">
                                                   <button type='button' class="btn m-0 remove-question"><i class="bx bx-x align-middle text-danger"></i></button>
                                                   </div>`;
                             let parentContainer = $(element).find('div[class="border mb-1 pb-2 pt-1"]');
                             $(imageContainer).prependTo(parentContainer);
                         }
         
                         let imgPreview = $(element).find('.quesitonImage-preview');
                         reader.onload = function(e) {
         
                             $(imgPreview).css('background-image', 'url('+e.target.result +')');
                             $(imgPreview).find('.quesitonImage-preview').hide();
                             $(imgPreview).find('.quesitonImage-preview').fadeIn(650);
                         }
                         reader.readAsDataURL(this.files[0]);
         
                         $(element).find('.remove-question').on('click', function(e) {
                             e.preventDefault();
                             $(imgPreview).fadeOut(650);
                             $(imgPreview).css('background-image', 'url()');
                             $(imgPreview).remove();
                         })
                     }
                 })
             });
        }
    
        function readAnswerUrl() {
            $('.answer').each((index, element) => {
                let imgInput =  $(element).find('.answerImageUpload');
        
                $(imgInput).change(function() {
                    if (this.files && this.files[0]) {
                        let reader = new FileReader();
                        if (!$(element).find('.answerImage-preview').length) {
                            let imageContainer = `<div style='background-image: url();' class='answerImage-preview users-avatar-shadow' width="240" height="240">
                                                  <button type='button' class="btn m-0 remove-answer"><i class="bx bx-x align-middle text-danger"></i></button>
                                                  </div>`;
                            let parentContainer = $(element).find('div[class="col-10 pl-0"]');
                            $(imageContainer).prependTo(parentContainer);
                        }
        
                        let imgPreview = $(element).find('.answerImage-preview');
                        reader.onload = function(e) {
        
                            $(imgPreview).css('background-image', 'url('+e.target.result +')');
                            $(imgPreview).find('.answerImage-preview').hide();
                            $(imgPreview).find('.answerImage-preview').fadeIn(650);
                        }
                        reader.readAsDataURL(this.files[0]);
        
                        $(element).find('.remove-answer').on('click', function(e) {
                            e.preventDefault();
                            $(imgPreview).fadeOut(650);
                            $(imgPreview).css('background-image', 'url()');
                            $(imgPreview).remove();
                        })
                    }
                })
            })
        }
    
        function readTasksUrl() {
            $('.task').each((index, element) => {
                let imgInput =  $(element).find('.taskImageUpload');
        
                $(imgInput).change(function() {
                    if (this.files && this.files[0]) {
                        let reader = new FileReader();
                        if (!$(element).find('.taskImage-preview').length) {
                            let imageContainer = `<div style='background-image: url();' class='taskImage-preview users-avatar-shadow' width="240" height="240">
                                                  <button type='button' class="btn m-0 remove-task"><i class="bx bx-x align-middle text-danger"></i></button>
                                                  </div>`;
                            let parentContainer = $(element).find('div[class="col-md-11"]');
                            $(imageContainer).prependTo(parentContainer);
                        }
        
                        let imgPreview = $(element).find('.taskImage-preview');
                        reader.onload = function(e) {
        
                            $(imgPreview).css('background-image', 'url('+e.target.result +')');
                            $(imgPreview).find('.taskImage-preview').hide();
                            $(imgPreview).find('.taskImage-preview').fadeIn(650);
                        }
                        reader.readAsDataURL(this.files[0]);
        
                        $(element).find('.remove-task').on('click', function(e) {
                            e.preventDefault();
                            $(imgPreview).fadeOut(650);
                            $(imgPreview).css('background-image', 'url()');
                            $(imgPreview).remove();
                        })
                    }
                })
            })
        }
    
        // let hintObserver = new MutationObserver(function(mutations) {
        //     mutations.forEach(function(mutation) {
        //         handleHintBox();
        //     });    
        // });
    
        // hintObserver.observe($('div[data-repeater-list="tasks"]')[0], {
        //     childList: true, 
        // });
    
        // function handleHintBox() {
        //     $('.hint-box').each(function(index, element) {
        //         let button = $(element).find('.hint-button');
        //         let hintbox = $(element).find('.hint-popover');
        //         $(button).attr('id', index + 'hintButton');
        //         $(hintbox).attr('id', index + 'hintPopover');
        //         $(`#${index}hintButton`).on('click', function() {
        //             $(`#${index}hintPopover`).toggle();
        //         });
        //     });
        // }
    })

})(window);