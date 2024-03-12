
    const myCollapsible = document.getElementById('menuCollapse')
    myCollapsible.addEventListener('show.bs.collapse', function () {
    document.body.style.overflow = "hidden";
});

    myCollapsible.addEventListener('hidden.bs.collapse', function () {
    document.body.style.overflow = "scroll";
});
