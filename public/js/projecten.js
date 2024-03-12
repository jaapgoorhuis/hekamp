const myCollapsible = document.getElementById('menuCollapse')
myCollapsible.addEventListener('show.bs.collapse', function () {

    document.getElementById('project-full-page-box').style.overflow = "hidden";
});

myCollapsible.addEventListener('hidden.bs.collapse', function () {
    document.getElementById('project-full-page-box').style.overflow = "scroll";
});
