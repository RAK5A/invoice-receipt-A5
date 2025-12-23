/* // Toggle the visibility of a dropdown menu
const toggleDropdown = (dropdown, menu, isOpen) => {
  dropdown.classList.toggle("open", isOpen);
  menu.style.height = isOpen ? `${menu.scrollHeight}px` : 0;
};

// Close all open dropdowns
const closeAllDropdowns = () => {
  document.querySelectorAll(".dropdown-container.open").forEach((openDropdown) => {
    toggleDropdown(openDropdown, openDropdown.querySelector(".dropdown-menu"), false);
  });
};

// Attach click event to all dropdown toggles
document.querySelectorAll(".dropdown-toggle").forEach((dropdownToggle) => {
  dropdownToggle.addEventListener("click", (e) => {
    e.preventDefault();

    const dropdown = dropdownToggle.closest(".dropdown-container");
    const menu = dropdown.querySelector(".dropdown-menu");
    const isOpen = dropdown.classList.contains("open");

    closeAllDropdowns(); // Close all open dropdowns
    toggleDropdown(dropdown, menu, !isOpen); // Toggle current dropdown visibility
  });
});

// Attach click event to sidebar toggle buttons
document.querySelectorAll(".sidebar-toggler, .sidebar-menu-button").forEach((button) => {
  button.addEventListener("click", () => {
    closeAllDropdowns(); // Close all open dropdowns
    document.querySelector(".sidebar").classList.toggle("collapsed"); // Toggle collapsed class on sidebar
  });
});

// Collapse sidebar by default on small screens
if (window.innerWidth <= 1024) document.querySelector(".sidebar").classList.add("collapsed"); */


// Check if sidebar state is saved in localStorage
const savedSidebarState = localStorage.getItem("sidebarCollapsed");
const isCollapsed = savedSidebarState === "true";

// Initialize sidebar state
if (isCollapsed) {
    document.querySelector(".sidebar").classList.add("collapsed");
} else {
    document.querySelector(".sidebar").classList.remove("collapsed");
}

// Toggle the visibility of a dropdown menu
const toggleDropdown = (dropdown, menu, isOpen) => {
    dropdown.classList.toggle("open", isOpen);
    menu.style.height = isOpen ? `${menu.scrollHeight}px` : 0;
};

// Close all open dropdowns
const closeAllDropdowns = () => {
    document
        .querySelectorAll(".dropdown-container.open")
        .forEach((openDropdown) => {
            toggleDropdown(
                openDropdown,
                openDropdown.querySelector(".dropdown-menu"),
                false
            );
        });
};

// Attach click event to all dropdown toggles
document.querySelectorAll(".dropdown-toggle").forEach((dropdownToggle) => {
    dropdownToggle.addEventListener("click", (e) => {
        // Prevent default only if it's a dropdown toggle (not a link)
        if (
            !dropdownToggle.getAttribute("href") ||
            dropdownToggle.getAttribute("href") === "#"
        ) {
            e.preventDefault();
        }

        const dropdown = dropdownToggle.closest(".dropdown-container");
        const menu = dropdown.querySelector(".dropdown-menu");
        const isOpen = dropdown.classList.contains("open");

        closeAllDropdowns(); // Close all open dropdowns
        toggleDropdown(dropdown, menu, !isOpen); // Toggle current dropdown visibility

        // Don't collapse sidebar on dropdown clicks
        e.stopPropagation();
    });
});

// Attach click event to sidebar toggle buttons
document
    .querySelectorAll(".sidebar-toggler, .sidebar-menu-button")
    .forEach((button) => {
        button.addEventListener("click", () => {
            const sidebar = document.querySelector(".sidebar");
            const isCollapsing = !sidebar.classList.contains("collapsed");

            // Toggle collapsed class on sidebar
            sidebar.classList.toggle("collapsed");

            // Save state to localStorage
            localStorage.setItem("sidebarCollapsed", isCollapsing);

            // Close all open dropdowns only on mobile
            if (window.innerWidth <= 768) {
                closeAllDropdowns();
            }
        });
    });

// Don't collapse sidebar on regular link clicks
document
    .querySelectorAll(".nav-link[href], .dropdown-link[href]")
    .forEach((link) => {
        link.addEventListener("click", function (e) {
            // Don't collapse sidebar when clicking links
            e.stopPropagation();

            // For mobile, close sidebar if it's open
            if (
                window.innerWidth <= 768 &&
                !this.classList.contains("dropdown-toggle")
            ) {
                document.querySelector(".sidebar").classList.add("collapsed");
                localStorage.setItem("sidebarCollapsed", "true");
            }
        });
    });

// Collapse sidebar by default on small screens
if (window.innerWidth <= 1024) {
    // Only collapse if not already saved
    if (savedSidebarState === null) {
        document.querySelector(".sidebar").classList.add("collapsed");
        localStorage.setItem("sidebarCollapsed", "true");
    }
}

// Close dropdowns when clicking outside (desktop only)
document.addEventListener("click", function (e) {
    if (window.innerWidth > 768) {
        // Check if click is outside any dropdown
        if (!e.target.closest(".dropdown-container")) {
            closeAllDropdowns();
        }
    }
});

// Handle window resize
let resizeTimer;
window.addEventListener("resize", function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
        // On mobile, collapse sidebar
        if (window.innerWidth <= 768) {
            document.querySelector(".sidebar").classList.add("collapsed");
            localStorage.setItem("sidebarCollapsed", "true");
            closeAllDropdowns();
        }
        // On desktop, restore saved state
        else if (window.innerWidth > 768) {
            const savedState =
                localStorage.getItem("sidebarCollapsed") === "true";
            document
                .querySelector(".sidebar")
                .classList.toggle("collapsed", savedState);
        }
    }, 250);
});
