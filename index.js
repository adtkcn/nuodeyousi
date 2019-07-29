var submit = document.getElementById("submit");
var text = document.getElementById("text");
var modal = document.getElementById("modal");
console.log(text);

modal.onclick = function() {
    modal.style.display = "none";
};

submit.onclick = function() {
    if (text.value && text.value.length == 11) {
        console.log(text.value);

        axios
            .post("https://1241711822969781.cn-hangzhou.fc.aliyuncs.com/2016-08-15/proxy/demo/dingding/", {
                content: "咨询留学电话：" + text.value
            })
            .then(function(response) {
                console.log(response);
                if (response.data && response.data.errcode == 0) {
                    modal.style.display = "block";
                } else {
                    alert("失败,你可以主动联系：");
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    }
};

function getElementLeft(ele) {
    var left = ele.offsetLeft;
    var cur = ele.offsetParent;
    console.log(ele);

    if (cur != null) {
        left += getElementLeft(cur);
    }
    return left;
}

function move(id) {
    var ele = document.getElementById(id);
    var left = getElementLeft(ele);
    document.documentElement.scrollTop = left;
    moveMain(-left);
    console.log("left", left);
}

function moveMain(Top) {
    mainContent.style.webkitTransform = "translateX(" + Top + "px)";
    mainContent.style.mozTransform = "translateX(" + Top + "px)";
    mainContent.style.msTransform = "translateX(" + Top + "px)";
    mainContent.style.transform = "translateX(" + Top + "px)";
}
var screenWidth = 0;
function resize() {
    screenWidth = document.documentElement.clientWidth;

    if (screenWidth > 750) {
        scrollDiv.style.display = "block";
        scrollDiv.style.height = mainContent.offsetWidth - document.documentElement.clientWidth + main.offsetHeight + "px";
    } else {
        scrollDiv.style.display = "none";
        moveMain(0);
    }
}
// window.onload = function() {
console.log(main.offsetHeight);

resize();
window.onresize = resize;
window.onscroll = function() {
    if (screenWidth > 750) {
        var Top = -parseInt(document.documentElement.scrollTop);
        moveMain(Top);
    }
};
// };
