const routes = [
  {
    path: "/",
    //name: "home",
    component: () => import("@/views/Home.vue"),
    children: [
      {
        path: "",
        component: () => import("@/views/Tramites.vue")
      },
      {
        path: "categorias",
        component: () => import("@/views/Categorias.vue")
      },
      {
        path: "etiquetas",
        component: () => import("@/views/Etiquetas.vue")
      }
    ]
  },
  {
    path: "*",
    redirect: "/"
  }
];

export default routes;
