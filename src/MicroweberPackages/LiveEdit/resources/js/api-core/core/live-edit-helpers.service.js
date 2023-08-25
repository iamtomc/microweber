export default {
    targetIsIcon: target => {
    
        if(!target) {
            return false;
        }

        if(!target.classList) {
            return false;
        }

        const iconClasses = ['icon', 'mw-icon', 'material-icons', 'mdi'];
        var isIcon = target.className.includes('mw-micon-');
    
        if(!isIcon) {
            for (let i = 0; i < iconClasses.length; i++) {
                if (target.classList.contains(iconClasses)) {
                    isIcon = true;
                    break;
                }
            }
        }
        // console.log(isIcon)
        return isIcon;
    }
}