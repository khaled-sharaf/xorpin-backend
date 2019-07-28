import Vue from 'vue'


Vue.directive('selectcolumn', {
    inserted(el, binding, vnode) {
    $(el).select2({
            closeOnSelect: false,
            dropdownAutoWidth: true
        })
        .on("select2:select", () => {
            vnode.context.tableData.filter.columns = $(el).val();
            // vnode.context.$emit('getData');
        })
        .on("select2:unselect", () => {
            vnode.context.tableData.filter.columns = $(el).val();
        })
        .bind(this);
    },
    update(el) {
        $(el).trigger("change");
    }
})

Vue.directive('selectviewtableclass', {
    inserted(el, binding, vnode) {
        $(el).select2({
            closeOnSelect: false,
            dropdownAutoWidth: true
        })
        .on("select2:select", () => {
            vnode.context.tableData.filter.viewTable = $(el).val();
            // vnode.context.$emit('getData');
        })
        .on("select2:unselect", () => {
            vnode.context.tableData.filter.viewTable = $(el).val();
        })
        .bind(this);
    },
    update(el) {
        $(el).trigger("change");
    }
})

Vue.directive('selectcolumnopen', {
    inserted(el) {
        $(el).click(function() {
            $(el)
            .find("> select")
            .select2("open");
        });
    }
})


Vue.directive('select2address', {
    inserted(el, binding, vnode) {
        $(el).select2({
            closeOnSelect: true,
            dropdownAutoWidth: true,
            dir: 'rtl'
        })
        .on("select2:select", () => {
            vnode.context.form.address = $(el).val();
        })
        // .on("select2:unselect", () => {
        //     vnode.context.tableData.filter.viewTable = $(el).val();
        // })
        .bind(this);
    },
    update(el) {
        $(el).trigger("change");
    }
})
