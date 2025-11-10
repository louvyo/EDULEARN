/**
 * Timezone Utilities
 * Automatically converts UTC timestamps to user's local timezone
 */

const TimezoneUtils = {
    /**
     * Get user's timezone
     */
    getUserTimezone() {
        return Intl.DateTimeFormat().resolvedOptions().timeZone;
    },

    /**
     * Convert UTC datetime string to user's local time
     * @param {string} utcDateString - ISO 8601 datetime string from server (UTC)
     * @returns {Date} Date object in user's timezone
     */
    convertToLocalTime(utcDateString) {
        if (!utcDateString) return null;
        return new Date(utcDateString);
    },

    /**
     * Format date to readable string in user's timezone
     * @param {string} utcDateString - ISO 8601 datetime string
     * @param {Object} options - Intl.DateTimeFormat options
     * @returns {string} Formatted date string
     */
    formatDate(utcDateString, options = {}) {
        const date = this.convertToLocalTime(utcDateString);
        if (!date) return '';

        const defaultOptions = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        };

        return new Intl.DateTimeFormat('id-ID', { ...defaultOptions, ...options }).format(date);
    },

    /**
     * Format date for display (e.g., "11 Nov 2025")
     */
    formatDateOnly(utcDateString) {
        return this.formatDate(utcDateString, {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    },

    /**
     * Format time for display (e.g., "14:30")
     */
    formatTimeOnly(utcDateString) {
        return this.formatDate(utcDateString, {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });
    },

    /**
     * Get relative time string (e.g., "2 hari lagi", "3 jam lagi")
     * @param {string} utcDateString - ISO 8601 datetime string
     * @returns {string} Relative time string
     */
    getRelativeTime(utcDateString) {
        const date = this.convertToLocalTime(utcDateString);
        if (!date) return '';

        const now = new Date();
        const diffMs = date - now;
        const diffSec = Math.floor(diffMs / 1000);
        const diffMin = Math.floor(diffSec / 60);
        const diffHour = Math.floor(diffMin / 60);
        const diffDay = Math.floor(diffHour / 24);

        if (diffMs < 0) {
            // Past deadline
            const absDiffDay = Math.abs(diffDay);
            const absDiffHour = Math.abs(diffHour);
            const absDiffMin = Math.abs(diffMin);

            if (absDiffDay > 0) return `${absDiffDay} hari yang lalu`;
            if (absDiffHour > 0) return `${absDiffHour} jam yang lalu`;
            if (absDiffMin > 0) return `${absDiffMin} menit yang lalu`;
            return 'Baru saja';
        }

        // Future deadline
        if (diffDay > 0) return `${diffDay} hari lagi`;
        if (diffHour > 0) return `${diffHour} jam lagi`;
        if (diffMin > 0) return `${diffMin} menit lagi`;
        return 'Kurang dari 1 menit';
    },

    /**
     * Get countdown string (e.g., "2h 14j 30m")
     * @param {string} utcDateString - ISO 8601 datetime string
     * @returns {Object} { text: string, isUrgent: boolean, isPast: boolean }
     */
    getCountdown(utcDateString) {
        const date = this.convertToLocalTime(utcDateString);
        if (!date) return { text: '', isUrgent: false, isPast: false };

        const now = new Date();
        const diff = date - now;

        if (diff <= 0) {
            return {
                text: 'Deadline terlewat',
                isUrgent: false,
                isPast: true
            };
        }

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        let countdownText = '';
        if (days > 0) {
            countdownText = `${days}h ${hours}j ${minutes}m`;
        } else if (hours > 0) {
            countdownText = `${hours}j ${minutes}m ${seconds}d`;
        } else if (minutes > 0) {
            countdownText = `${minutes}m ${seconds}d`;
        } else {
            countdownText = `${seconds}d`;
        }

        const isUrgent = days === 0 && hours < 24; // Less than 24 hours

        return {
            text: countdownText,
            isUrgent: isUrgent,
            isPast: false
        };
    },

    /**
     * Initialize all datetime elements on the page
     */
    initializePage() {
        // Update all elements with data-utc-time attribute
        document.querySelectorAll('[data-utc-time]').forEach(el => {
            const utcTime = el.getAttribute('data-utc-time');
            const format = el.getAttribute('data-format') || 'full';

            let formattedTime = '';
            switch (format) {
                case 'date':
                    formattedTime = this.formatDateOnly(utcTime);
                    break;
                case 'time':
                    formattedTime = this.formatTimeOnly(utcTime);
                    break;
                case 'relative':
                    formattedTime = this.getRelativeTime(utcTime);
                    break;
                default:
                    formattedTime = this.formatDate(utcTime);
            }

            el.textContent = formattedTime;
        });

        // Update countdown elements
        this.updateCountdowns();
    },

    /**
     * Update all countdown timers
     */
    updateCountdowns() {
        document.querySelectorAll('.countdown').forEach(el => {
            const deadline = el.getAttribute('data-deadline');
            if (!deadline) return;

            const countdown = this.getCountdown(deadline);
            el.textContent = countdown.text;

            // Update classes based on urgency
            el.classList.remove('text-red-600', 'text-orange-600', 'text-green-600', 'font-semibold');
            if (countdown.isPast) {
                el.classList.add('text-red-600', 'font-semibold');
            } else if (countdown.isUrgent) {
                el.classList.add('text-orange-600', 'font-semibold');
            } else {
                el.classList.add('text-gray-600');
            }
        });
    },

    /**
     * Start automatic countdown updates
     */
    startCountdownUpdates() {
        // Update immediately
        this.updateCountdowns();

        // Update every second
        setInterval(() => {
            this.updateCountdowns();
        }, 1000);
    }
};

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        TimezoneUtils.initializePage();
        TimezoneUtils.startCountdownUpdates();
    });
} else {
    TimezoneUtils.initializePage();
    TimezoneUtils.startCountdownUpdates();
}

// Make available globally
window.TimezoneUtils = TimezoneUtils;
