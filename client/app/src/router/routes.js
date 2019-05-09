const routes = [
  {
    path: "/",
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
      },
      {
        path: "tramites/:id",
        component: () => import("@/views/TramiteDetail.vue")
      },
      {
        path: "categorias/:id",
        component: () => import("@/views/CategoriaDetail.vue")
      },
      {
        path: "etiquetas/:id",
        component: () => import("@/views/EtiquetaDetail.vue")
      }
    ]
  },
  {
    path: "/login",
    component: () => import("@/views/Login.vue")
  },
  {
    path: "*",
    redirect: "/"
  }
];

export default routes;
