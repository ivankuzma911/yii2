var base ={

    cookieName:'checkboxes',
    checkedCheckBoxes:'.checkboxes input[type=checkbox]:checked',
    notCheckedCheckBoxes:'.checkboxes input[type=checkbox]:not(:checked)',
    checkBoxSelector:'.checkboxes input[type=checkbox]',
    checkAllButton:'#check-all',


    checkCookieName:function(){
        if($.cookie(this.cookieName) == null){
            $.cookie(this.cookieName, '', { expires: 1});
        }
    },

    makeCheckBox:function (elem){
        var self = this;
        if(self.isSetCookieValue(elem)){
            var newValue = self.cookieValueBeforeDelete(elem);
            $.cookie(this.cookieName, newValue,{ expires: 1});
        }else {
            $.cookie(this.cookieName, $.cookie(this.cookieName) + ',' + elem,{expires: 1});
        }
    },

    cookieValueBeforeDelete:function (value){
        var values = $.cookie(this.cookieName).split(',');
        for(var j=0; j<values.length; j++){
            if(values[j] == value){
                values.splice(j,1);
                return values.join(',');
            }
        }
    },

    allCheck:function(){
        var self = this;
        if( $(this.checkedCheckBoxes).length != $(this.checkBoxSelector).length){
            $(this.notCheckedCheckBoxes).each(function(){
                self.makeCheckBox($(this).val());
                $(this).prop('checked', true);
            })
        }else{
            $(this.checkedCheckBoxes).each(function(){
                self.makeCheckBox($(this).val());
                $(this).prop('checked', false);
            })
        }
    },

    isSetCookieValue:function (value){
        var values = $.cookie(this.cookieName).split(',');
        for(var i=0;i<values.length;i++){
            if(values[i] == value){
                return true;
            }
        }
        return false;
    }
};

var builder={
    addEventListeners:function(){
        var self = this;
        $(this.checkBoxSelector).click(function(){
            self.makeCheckBox($(this).val());
        });
        $(this.checkAllButton).click(function(){
            self.allCheck();
        })
    },

   checkCheckBoxes: function (){
       var self = this;
        $(this.checkBoxSelector).each(function(){
            if(self.isSetCookieValue($(this).val())){
                $(this).prop('checked', true);
            }
        })
    }
};

builder.__proto__ = base;

var runner = {
    run:function(){
        this.checkCookieName();
        this.addEventListeners();
        this.checkCheckBoxes();
    }
};

runner.__proto__ = builder;
runner.run();

