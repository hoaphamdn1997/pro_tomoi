
// var textCircles = document.querySelectorAll(".text-circle");

// textCircles.forEach(function(textCircle) { b=textCircle.innerHTML.replace("%", "");
// // Math.random()
//     var percent =  b* 100;
//     var x = (percent * 360) / 100;
//     var angle = 0;
//     var leftContent = document.querySelectorAll(".left-content");
//     var rightContent = document.querySelectorAll(".right-content");
//     var timerId = setInterval(function() {
//         for (angle; angle <= x; angle += 10) {
//             if (angle > 360) {
//                 clearInterval(timerId);
//             } else {
//                 if (angle > 180) {
//                     rightContent[0][0].attr('style', 'transform: rotate(' + (angle - 180) + 'deg)');
//                 } else {
//                     leftContent[1][1].attr('style', 'transform: rotate(' + angle + 'deg)');
//                 }
//                 setPercent(angle);
//             }
//         }
//     }, 500);
// });
var bd = document.querySelectorAll('.con');
bd.forEach(function(bd) {
    var leftContent = bd.querySelector(".left-content");
    var rightContent = bd.querySelector(".right-content");
    var textCircle = bd.querySelector(".text-circle");

    var b = bd.querySelector(".text-circle").innerHTML.replace('%', '')
    var percent = b;
    var x = (percent * 360) / 100;
    var angle = 0;
    var timerId = setInterval(function() {
        for (angle; angle <= x; angle += 10) {
            if (angle > 360) {
                clearInterval(timerId);
            } else {
                if (angle > 180) {
                    rightContent.setAttribute('style', 'transform: rotate(' + (angle - 180) + 'deg)');
                } else {
                    leftContent.setAttribute('style', 'transform: rotate(' + angle + 'deg)');
                }
                setPercent(angle);

            }
        }

    }, 500);

    function setPercent(angle) {
        textCircle.innerHTML = bd.querySelector(".text-circle").innerHTML.replace('%', '') + '%';
    }
})