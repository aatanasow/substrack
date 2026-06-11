document.addEventListener("DOMContentLoaded", () => {

    const btn = document.querySelector("#headerCollapse");
    const sidebar = document.querySelector("#applicationSidebar");
    const backdrop = document.querySelector("#sidebarBackdrop");
    const search = document.querySelector("#headerSearch");
    const searchbar = document.querySelector("#applicationSearch");

    if (btn) {
        btn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            backdrop.classList.toggle("hidden");
        });
    }

    if (backdrop) {
        backdrop.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            backdrop.classList.toggle("hidden");
        });
    }

    if (search) {
        search.addEventListener("click", () => {
            searchbar.classList.toggle("hidden");
        });
    }


    // // Get all tabs and tab panels
    // const tabs = document.querySelectorAll('[role="tab"]');
    // const panels = document.querySelectorAll('[role="tabpanel"]');

    // if (tabs) {
    //     tabs.forEach((tab) => {
    //         tab.addEventListener("click", () => {
    //             // Reset all tabs to inactive state
    //             tabs.forEach((t) => {
    //                 t.setAttribute("aria-selected", "false");
    //                 t.classList.remove(
    //                     "text-blue-700",
    //                     "border-blue-700",
    //                     "dark:text-blue-500",
    //                     "dark:border-blue-500",
    //                 );
    //                 t.classList.add("border-transparent");
    //             });

    //             // Hide all panels
    //             panels.forEach((panel) => panel.classList.add("hidden"));

    //             // Activate the clicked tab

    //             tab.setAttribute("aria-selected", "true");
    //             tab.classList.add(
    //                 "text-blue-700",
    //                 "border-blue-700",
    //                 "dark:text-blue-500",
    //                 "dark:border-blue-500",
    //             );
    //             tab.classList.remove("border-transparent");

    //             // Show the related panel
    //             document
    //                 .getElementById(tab.getAttribute("aria-controls"))
    //                 .classList.remove("hidden");
    //         });
    //     });
    // }
});
