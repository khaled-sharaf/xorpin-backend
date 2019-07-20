<template>
  <div class="row">
    <div class="col-sm-12 col-md-5">
      <div class="dataTables_info">
        {{ $t('datatable.showing') }}
        <span class="from">{{pagination.from}}</span> {{ $t('datatable.to') }}
        <span class="to">{{pagination.to}}</span> {{ $t('datatable.of') }}
        <span class="total">{{pagination.total}}</span> {{ $t('datatable.entries') }}
      </div>
    </div>
    <div class="col-sm-12 col-md-7">
      <div class="dataTables_paginate">
        <ul class="pagination">
          <li class="page-item">
            <a
              v-if="pagination.prevPageUrl"
              @click="$emit('prev');"
              tabindex="0"
              class="page-link"
            >{{ $t('datatable.prev') }}</a>
            <a v-else :disabled="true" class="disabled page-link" tabindex="0">{{ $t('datatable.prev') }}</a>
          </li>
          <!-- first page link -->
          <li
            class="paginate_button page-item"
            :class="pagination.currentPage == 1 ? 'active' : ''"
            v-if="totalLink > 2 && pagination.currentPage > 2"
          >
            <a @click="$emit('gotopage', 1);" data-dt-idx="1" tabindex="0" class="page-link">1</a>
          </li>
          <li v-if="totalLink > 2 && pagination.currentPage > 3">...</li>

          <!-- all page links -->
          <li
            class="paginate_button page-item"
            v-for="i in totalLink"
            :key="Math.random() * i * 100"
            v-show="(pagination.currentPage - 1) == i"
          >
            <a
              @click="$emit('gotopage', i);"
              :data-dt-idx="i"
              tabindex="0"
              class="page-link"
            >{{ i }}</a>
          </li>

          <li
            class="paginate_button page-item"
            v-for="i in totalLink"
            :key="Math.random() * i * 101"
            :class="pagination.currentPage == i ? 'active' : ''"
            v-show="pagination.currentPage == i"
          >
            <a
              @click="$emit('gotopage', i);"
              :data-dt-idx="i"
              tabindex="0"
              class="page-link"
            >{{ i }}</a>
          </li>

          <li
            class="paginate_button page-item"
            v-for="i in totalLink"
            :key="Math.random() * i * 102"
            v-show="(pagination.currentPage + 1) == i"
          >
            <a
              @click="$emit('gotopage', i);"
              :data-dt-idx="i"
              tabindex="0"
              class="page-link"
            >{{ i }}</a>
          </li>

          <!-- last page link -->
          <li v-if="totalLink > 2 && (totalLink - pagination.currentPage) > 2">...</li>
          <li
            class="paginate_button page-item"
            :class="pagination.currentPage == totalLink ? 'active' : ''"
            v-if="totalLink > 2 && (totalLink - pagination.currentPage) > 1 && pagination.currentPage >= 2"
          >
            <a
              @click="$emit('gotopage', totalLink);"
              :data-dt-idx="totalLink"
              tabindex="0"
              class="page-link"
            >{{ totalLink }}</a>
          </li>

          <li class="page-item">
            <a
              v-if="pagination.nextPageUrl"
              @click="$emit('next');"
              tabindex="0"
              class="page-link"
            >{{ $t('datatable.next') }}</a>
            <a v-else :disabled="true" class="disabled page-link" tabindex="0">{{ $t('datatable.next') }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>


<script>
export default { props: ["pagination", "totalLink"] };
</script>

