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
        component: () => import("@/views/TramiteDetail.vue"),
        children: [
          {
            path: "edit",
            component: () => import("@/views/TramiteDetail.vue"),
            meta: { requiresAuth: true }
          }
        ]
      },
      {
        path: "categorias/:id",
        component: () => import("@/views/CategoriaDetail.vue"),
        children: [
          {
            path: "edit",
            component: () => import("@/views/CategoriaDetail.vue"),
            meta: { requiresAuth: true }
          }
        ]
      },
      {
        path: "etiquetas/:id",
        component: () => import("@/views/EtiquetaDetail.vue"),
        children: [
          {
            path: "edit",
            meta: { requiresAuth: true },
            component: () => import("@/views/EtiquetaDetail.vue")
          }
        ]
      },
      {
        path: "documentos/:id/edit",
        meta: { requiresAuth: true },
        component: () => import("@/views/DocumentoDetail.vue")
      }
    ]
  },
  {
    path: "/login",
    component: () => import("@/views/Login.vue")
  },
  {
    path: "/admin",
    component: () => import("@/views/Admin.vue"),
    meta: { requiresAuth: true }
  },
  {
    path: "*",
    redirect: "/"
  }
];

export default routes;
