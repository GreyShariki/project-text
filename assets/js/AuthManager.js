export class AuthManager {
  async authenticate(form) {
    try {
      const formData = new FormData(form);
      const fetchResponse = await fetch(`index.php?action=authenticate`, {
        method: "POST",
        body: formData,
      });
      const text = await fetchResponse.json();
      const data = JSON.parse(text);
      console.log(data);
      return data;
    } catch (error) {
      console.log(error);
    }
  }
  async logout() {
    try {
      const response = await fetch("index.php?action=logout");
      const text = await response.json();
      const data = JSON.parse(text);
      return data;
    } catch (error) {
      console.log(error);
    }
  }
}
