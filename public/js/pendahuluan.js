/**
 * public/js/pendahuluan.js
 * p5 sketch responsif + rapi di dalam wrapper #p5Pendahuluan
 * - WAJIB instance mode
 * - Canvas selalu ikut lebar container
 * - Tinggi mengikuti aspect ratio wrapper (16:9) dengan min-height
 * - Tidak “loncat” keluar layout
 */

(function () {
  // Pastikan dijalankan setelah DOM ada
  const boot = () => {
    const mountId = "p5Pendahuluan";
    const mount = document.getElementById(mountId);

    if (!mount) {
      console.warn(`[p5] Container #${mountId} tidak ditemukan.`);
      return;
    }

    // Helper: hitung ukuran canvas dari wrapper
    const calcSize = () => {
      const w = mount.clientWidth || 600;

      // Kalau wrapper pakai aspect-ratio: 16/9, tinggi bisa diambil dari clientHeight
      // Tapi jika clientHeight 0 (kadang saat hidden), fallback ke 16:9
      let h = mount.clientHeight;
      if (!h || h < 50) h = Math.round(w * 9 / 16);

      // Batas bawah biar enak di HP
      h = Math.max(h, 260);
      return { w, h };
    };

    new p5((p) => {
      let canvas;
      let pts = [];
      let draggingIndex = -1;

      const margin = { l: 60, r: 18, t: 22, b: 46 };
      const yMin = 0, yMax = 100;

      // Mapping util
      const clamp = (v, a, b) => Math.max(a, Math.min(b, v));
      const lerp = (a, b, t) => a + (b - a) * t;

      const plotRect = () => ({
        x: margin.l,
        y: margin.t,
        w: p.width - margin.l - margin.r,
        h: p.height - margin.t - margin.b
      });

      const xToPx = (i) => {
        const pr = plotRect();
        const n = pts.length - 1;
        return pr.x + (pr.w * (n === 0 ? 0 : i / n));
      };

      const yToPx = (val) => {
        const pr = plotRect();
        const t = (val - yMin) / (yMax - yMin);
        return pr.y + pr.h * (1 - t);
      };

      const pxToY = (py) => {
        const pr = plotRect();
        const t = 1 - (py - pr.y) / pr.h;
        const val = yMin + t * (yMax - yMin);
        return clamp(val, yMin, yMax);
      };

      const hitTest = (mx, my) => {
        for (let i = 0; i < pts.length; i++) {
          const px = xToPx(i);
          const py = yToPx(pts[i]);
          if (p.dist(mx, my, px, py) <= 14) return i;
        }
        return -1;
      };

      p.setup = () => {
        const { w, h } = calcSize();

        canvas = p.createCanvas(w, h);
        canvas.parent(mountId);

        // Biar canvas benar-benar ngikut wrapper (tidak bikin gap/overflow)
        canvas.elt.style.display = "block";
        canvas.elt.style.width = "100%";
        canvas.elt.style.height = "100%";

        // Data awal (bisa kamu ubah)
        pts = [40, 65, 22, 50, 40, 70];

        // Supaya drag enak di touch device
        canvas.elt.style.touchAction = "none";
      };

      p.draw = () => {
        p.clear();
        p.background(255);

        // Background halus biar match tema
        // (pakai stroke abu tipis, tidak perlu color fancy)
        const pr = plotRect();

        // Grid
        p.noFill();
        p.stroke(230);
        p.strokeWeight(1);

        // garis vertikal grid
        const vx = 7;
        for (let i = 0; i < vx; i++) {
          const x = pr.x + (pr.w * i) / (vx - 1);
          p.line(x, pr.y, x, pr.y + pr.h);
        }

        // garis horizontal grid
        const hy = 6;
        for (let j = 0; j < hy; j++) {
          const y = pr.y + (pr.h * j) / (hy - 1);
          p.line(pr.x, y, pr.x + pr.w, y);
        }

        // Axis
        p.stroke(60);
        p.strokeWeight(2);
        p.line(pr.x, pr.y, pr.x, pr.y + pr.h);           // y axis
        p.line(pr.x, pr.y + pr.h, pr.x + pr.w, pr.y + pr.h); // x axis

        // Label
        p.noStroke();
        p.fill(80);
        p.textSize(14);
        p.textAlign(p.LEFT, p.BOTTOM);
        p.text("Titik dapat digerakkan", pr.x, pr.y - 6);

        // Y-axis ticks + label
        p.fill(90);
        p.textSize(13);
        p.textAlign(p.RIGHT, p.CENTER);
        for (let t = 0; t <= 100; t += 20) {
          const y = yToPx(t);
          p.noStroke();
          p.text(String(t), pr.x - 10, y);
        }

        // Y label
        p.push();
        p.translate(18, pr.y + pr.h / 2);
        p.rotate(-p.HALF_PI);
        p.textAlign(p.CENTER, p.CENTER);
        p.text("Exam Score", 0, 0);
        p.pop();

        // Draw curve (smooth-ish) using Catmull-Rom like approach (manual)
        // Simpel: gunakan curveVertex
        p.noFill();
        p.stroke(30);
        p.strokeWeight(5);
        p.beginShape();
        for (let i = 0; i < pts.length; i++) {
          const x = xToPx(i);
          const y = yToPx(pts[i]);
          // trick: duplicate endpoints for curveVertex
          if (i === 0) p.curveVertex(x, y);
          p.curveVertex(x, y);
          if (i === pts.length - 1) p.curveVertex(x, y);
        }
        p.endShape();

        // Draw points
        for (let i = 0; i < pts.length; i++) {
          const x = xToPx(i);
          const y = yToPx(pts[i]);

          const hovered = (hitTest(p.mouseX, p.mouseY) === i) || (draggingIndex === i);

          p.noStroke();
          p.fill(20);
          p.circle(x, y, hovered ? 20 : 16);

          // value tooltip when hover/drag
          if (hovered) {
            p.fill(255);
            p.stroke(120);
            p.strokeWeight(1);

            const label = Math.round(pts[i]).toString();
            const tw = p.textWidth(label) + 16;
            const th = 24;
            const bx = x + 12;
            const by = y - 34;

            p.rect(bx, by, tw, th, 8);
            p.noStroke();
            p.fill(40);
            p.textAlign(p.LEFT, p.CENTER);
            p.text(label, bx + 8, by + th / 2);
          }
        }
      };

      // Mouse interactions
      p.mousePressed = () => {
        draggingIndex = hitTest(p.mouseX, p.mouseY);
      };

      p.mouseDragged = () => {
        if (draggingIndex !== -1) {
          const pr = plotRect();
          // batasi drag di area plot
          const y = clamp(p.mouseY, pr.y, pr.y + pr.h);
          pts[draggingIndex] = pxToY(y);
        }
      };

      p.mouseReleased = () => {
        draggingIndex = -1;
      };

      // Touch interactions
      p.touchStarted = () => {
        // gunakan touch pertama
        if (p.touches && p.touches.length) {
          const t = p.touches[0];
          draggingIndex = hitTest(t.x, t.y);
        } else {
          draggingIndex = hitTest(p.mouseX, p.mouseY);
        }
        return false;
      };

      p.touchMoved = () => {
        if (draggingIndex !== -1) {
          const pr = plotRect();
          const ty = (p.touches && p.touches.length) ? p.touches[0].y : p.mouseY;
          const y = clamp(ty, pr.y, pr.y + pr.h);
          pts[draggingIndex] = pxToY(y);
        }
        return false;
      };

      p.touchEnded = () => {
        draggingIndex = -1;
        return false;
      };

      // Responsif saat resize window / sidebar toggle
      p.windowResized = () => {
        // Kalau wrapper sedang hidden (display:none), ukuran bisa 0.
        // Jadi tunda sedikit sampai layout stabil.
        setTimeout(() => {
          const { w, h } = calcSize();
          // hindari resize ke 0
          if (w > 50 && h > 50) p.resizeCanvas(w, h);
        }, 60);
      };
    });
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", boot);
  } else {
    boot();
  }
})();