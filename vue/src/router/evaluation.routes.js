// permissions

const Index = () => import("../views/evaluations/Index.vue");
const Show = () => import("../views/evaluations/Show.vue");
const Edit = () => import("../views/evaluations/Edit.vue");
const Create = () => import("../views/evaluations/Create.vue");

const evaluationRoutes = [
  {
    path: "evaluations",
    name: "Evaluations",
    component: Index,
  },
  // create
  {
    path: "evaluations/create/:sideProfile_id",
    name: "CreateEvaluations",
    component: Create,
  },
  // show
  {
    path: "evaluations/:id",
    name: "ShowEvaluations",
    component: Show,
  },
  // edit
  {
    path: "evaluations/:id/edit",
    name: "EditEvaluations",
    component: Edit,
  },
];

export default {
  ...evaluationRoutes,
};
