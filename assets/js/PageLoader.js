class PageLoader {
  constructor(app) {
    this.app = app;
  }
  async loadPage(action) {
    try {
      const response = await fetch(`index.php?action=load${action}`);
      if (response.status === 401) {
        return response;
      } else {
        const html = await response.text();
        this.app.innerHTML = html;
        return html;
      }
    } catch (error) {
      console.log(error);
    }
  }
}
export default PageLoader;
