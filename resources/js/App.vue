<template>
  <v-app>
    <Header/>
    <Navigation/>
    <v-main>
      <v-container fluid>
        <Blog/>
      </v-container>
    </v-main>
    <Errors/>
    <Notifications/>
    <Footer/>
  </v-app>
</template>

<script>
import Header from "./components/Layout/Header";
import Navigation from "./components/Layout/Navigation";
import Footer from "./components/Layout/Footer";
import Blog from "./pages/Blog";
import Errors from "./components/Messages/Errors";
import Notifications from "./components/Messages/Notifications";

export default {
  components: {Notifications, Errors, Blog, Footer, Navigation, Header},
}
</script>
