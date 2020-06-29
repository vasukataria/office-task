<template>
  <div class="page-container">
    <md-app>
      <md-app-toolbar class="md-primary">
        <md-button class="md-icon-button" @click="toggleMenu" v-if="!menuVisible">
          <md-icon>menu</md-icon>
        </md-button>
        <span class="md-title">Admin..!!!</span>
        <div class="md-toolbar-section-end">
        <md-button @click="showSidepanel = true">Logout</md-button>
      </div>
      </md-app-toolbar>

      <md-app-drawer :md-active.sync="menuVisible" md-persistent="full">
        <md-toolbar class="md-transparent" md-elevation="0">
          <span>Power to you</span>

          <div class="md-toolbar-section-end">
            <md-button class="md-icon-button md-dense" @click="toggleMenu">
              <md-icon>keyboard_arrow_left</md-icon>
            </md-button>
          </div>
        </md-toolbar>

        <md-list>
          <md-list-item>
           
          <span class="workon"><router-link to="/Admin">Form</router-link></span>
          </md-list-item>

          <md-list-item>
    
            <span class="md-list-item-text"><router-link to="/Header">Header</router-link></span>
          </md-list-item>

        </md-list>
      </md-app-drawer>
      <Content> </Content>
    </md-app>
  </div>
</template>

<script>

import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import '../components/Content.vue'
  export default {
    name: 'Adminheader',
    components: {
   // Content,
    },
    data: () => ({
      menuVisible: false
    }),
    methods: {
      toggleMenu () {
        this.menuVisible = !this.menuVisible
      }
    }
  }
</script>

<style lang="scss" scoped>
  .md-app {
    min-height: 350px;
  }
  .workon{
    text-color: black;
  }
</style>