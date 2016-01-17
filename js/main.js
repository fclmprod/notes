/* Notes - v0.0.1
 * Main Script
 * 
 * I. Interactive Design
 *    - Day/Night color switch
 */

colorSwitch($("#colorSwitch + label"),$("body"),"day","night");
colorSwitch($("#colorSwitch + label"),$(".colorSwitch"),"night","day");

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