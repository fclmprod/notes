/* Notes - v0.0.1
 * Main Script
 * 
 * I. Interactive Design
 *    - Day/Night color switch
 */

colorSwitch($("#colorSwitch + label"),$("body"),"day","night");
colorSwitch($("#colorSwitch + label"),$(".colorSwitch"),"night","day");

anchor();

// Changement de couleur day/night
function colorSwitch(trigger,target,class1,class2){
    var checked = true;
    trigger.click(function(){
        if(checked){
          checked = false;     
        }
        else {
            checked = true;
        }
        checked ? target.removeClass(class2) : target.removeClass(class1);
        checked ? target.addClass(class1) : target.addClass(class2);
    });
} 

// Permet d'acceder à une ancre dans la colonne de droite.
function anchor(){
    var list = $("a");
    list.click(function() {
        var e = $(this).attr("href");
        if($(e).parent().attr('id')=="images"){
            var pos = $(e).offset().top;
            if(pos>1 || pos<0){
                console.log(pos);
                $('#images').animate({
                    scrollTop: pos
                }, 500);
            }
            return false;
        }
    });
}