<script>
    //all permission check by one click
    $("#checkPermissionAll").click(function() {
        //.is() is a default conditional method in javascript
        if ($(this).is(':checked')) {
            // check all the checkbox
            $('input[type=checkbox]').prop('checked', true);

        } else {
            // un check all the checkbox
            $('input[type=checkbox]').prop('checked', false);
        }
    });

    //group wise permission check
    function checkPermissionByGroup(className, thisVal) {
        const groupIdName = $("#" + thisVal.id);
        const classCheckBox = $('.' + className + ' input[type=checkbox]');

        if (groupIdName.is(':checked')) {
            classCheckBox.prop('checked', true);
        } else {
            classCheckBox.prop('checked', false);
        }
    }

    //if all those single permission is checked then group auto matically checked
    function checkSinglePermission(thisGrpClass, GrpId, totalPermission) {
        const allInput = $('.' + thisGrpClass + ' input[type=checkbox]');
        const GrpInput = $('#' + GrpId);

        if ($('.' + thisGrpClass + ' input[type=checkbox]:checked').length == totalPermission) {
            GrpInput.prop('checked', true);
        } else {
            GrpInput.prop('checked', false);
        }
    }

    //if every input checked then all checked will be auto checked
    function ifGroupAndSingleCheckBoxCheckedT() {
        //if all those single input is checked then all checked input field would be checked
        let allCheckBox = document.querySelectorAll('.customSingleInputClassForAllChecked input[type="checkbox"]');
        let AllCheckId = $('#checkPermissionAll');
        allCheckBox.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const allChecked = Array.from(allCheckBox).every(checkbox => checkbox.checked);

                if (allChecked) {
                    AllCheckId.prop('checked', true);
                } else {
                    AllCheckId.prop('checked', false);
                }
            });
        });
        //if all those group input is checked then all checked input field would be checked
        let allCheckBoxGrp = document.querySelectorAll('.permission_group input[type="checkbox"]');
        let AllCheckIdGrp = $('#checkPermissionAll');
        allCheckBoxGrp.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const allChecked = Array.from(allCheckBoxGrp).every(checkbox => checkbox.checked);

                if (allChecked) {
                    AllCheckIdGrp.prop('checked', true);
                } else {
                    AllCheckIdGrp.prop('checked', false);
                }
            });
        });
    }
    // just function call here for simplify. If I didn't implement all those code into ifGroupAndSingleCheckBoxCheckedT() function then it also works but.
    ifGroupAndSingleCheckBoxCheckedT();


</script>
