const app = document.getElementById("app");
const loadLoginForm = async () => {
  const resp = await fetch("index.php?action=loginForm");
  const html = await resp.text();
  app.innerHTML = html;
  initLoginForm();
};

const loadProfile = async () => {
  const resp = await fetch("index.php?action=profile");
  if (resp.status == 403) {
    await loadLoginForm();
    return;
  }
  const html = await resp.text();
  app.innerHTML = html;
  const btnLogout = document.getElementById("logout");
  btnLogout.addEventListener("click", async () => {
    const response = await fetch("index.php?action=logout");
    if (response.status == 200) {
      loadLoginForm();
    }
  });
  const btnTime = document.getElementById("datetime");
  btnTime.addEventListener("click", async () => {
    await showSessionTime();
  });
};

const initLoginForm = () => {
  const form = document.getElementById("loginForm");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const submitter = e.submitter;
    const authType = submitter?.value;
    const formData = new FormData(form);

    let action = authType === "db" ? "authWithDatabase" : "authWithFile";

    const resp = await fetch(`index.php?action=${action}`, {
      method: "POST",
      body: formData,
    });

    const data = await resp.json();

    if (data.status === "Успех") {
      await loadProfile();
    } else {
      alert(data.massage || "Ошибка авторизации");
    }
  });
};
const updateTime = async () => {
  const response = await fetch("index.php?action=getData");
  const time = await response.text();
  document.getElementById("clock").innerHTML = time + " секунд";
};
const showSessionTime = async () => {
  const response = await fetch("index.php?action=sessionDate");
  const html = await response.text();
  app.innerHTML = html;
  const btnBack = document.getElementById("back");
  btnBack.addEventListener("click", async () => {
    loadProfile();
  });
  updateTime();
  setInterval(updateTime, 1000);
};

loadProfile();
