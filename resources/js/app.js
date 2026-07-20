import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import Chart from "chart.js/auto";

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

    //calendar
    const calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: "dayGridMonth",
            events: {
                url: "/calendar/events",
                method: "GET",
            },
            eventClick(info) {
                // alert('/subscriptions/'+info.event.extendedProps.id);
                window.open(
                    "/subscriptions/" + info.event.extendedProps.id,
                    "_self",
                );
            },
            // showNonCurrentDates: false, // Hides dates from the previous and next months
            // lazyFetching: false, // Forces a new fetch every time the visible view changes

            // height: '100%',
        });

        calendar.render();
    }

    const monthlyChart = document.getElementById("monthlyChart");
    if (monthlyChart) {
        new Chart(monthlyChart, {
            type: "bar",

            data: {
                labels: monthlyChartLabels,
                datasets: monthlyChartDatasets,
            },

            options: {
                responsive: true,
                borderRadius: 5,
                maxBarThickness: 15,
                plugins: {
                    legend: {
                        display: true,
                        position: "top",
                        align: "end",
                        labels: {
                            usePointStyle: true,
                            pointStyle: "circle",
                        },
                    },
                },
                scales: {
                    x: {
                        border: {
                            display: true,
                        },
                        grid: {
                            display: false,
                        },
                    },
                    y: {
                        beginAtZero: true,
                        border: {
                            display: false,
                        },
                        grid: {
                            color: "#eeeeee",
                            tickBorderDash: [2, 2],
                        },
                    },
                },
            },
        });
    }

    const yearlyChart = document.getElementById("yearlyChart");
    if (yearlyChart) {
        new Chart(yearlyChart, {
            type: "doughnut",

            data: {
                labels: yearlyChartLabels,
                datasets: [
                    {
                        label: yearlyChartDatasets["label"],
                        data: yearlyChartDatasets["data"],
                    },
                ],
            },

            options: {
                responsive: true,
                cutout: "65%",
                borderRadius: 4,
                plugins: {
                    legend: {
                        display: true,
                        position: "bottom",
                        align: "center",
                        labels: {
                            usePointStyle: true,
                            pointStyle: "circle",
                        },
                    },
                },
            },
        });
    }

    const accordionButtons = document.querySelectorAll(".accordion-button");

    if (accordionButtons) {
        // 1. Initialize first item
        const firstContent = document.querySelector(".accordion-content");
        if (firstContent)
            firstContent.style.maxHeight = firstContent.scrollHeight + "px";

        // Helper function to update UI and Attributes
        const toggleItem = (btn, isOpen) => {
            const content = document.getElementById(
                btn.getAttribute("aria-controls"),
            );
            const arrowIcon = btn.querySelector(".arrow-icon");

            btn.setAttribute("aria-expanded", isOpen);
            content.setAttribute("aria-hidden", !isOpen);
            content.style.maxHeight = isOpen
                ? content.scrollHeight + "px"
                : "0px";

            // Toggle classes
            arrowIcon.classList.toggle("rotate-180", isOpen);

            const container = btn.closest(".parent-container");
            if (container) {
                container.classList.toggle("border-blue-600", isOpen);
                container.classList.toggle("border-transparent", !isOpen);
                container.classList.toggle("dark:border-blue-500", isOpen);
            }
        };

        accordionButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const isExpanding =
                    button.getAttribute("aria-expanded") !== "true";

                // Close all items
                accordionButtons.forEach((btn) => toggleItem(btn, false));

                // If the clicked one was closed, open it
                if (isExpanding) toggleItem(button, true);
            });
        });
    }
});
