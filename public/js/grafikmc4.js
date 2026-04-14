let grafikMc4P5 = null;
let titikMc4 = [];
let tampilKurvaMc4 = false;

const GRAFIK_MC4 = {
    xMin: -4,
    xMax: 5,
    yMin: -20,
    yMax: 30,
    padding: 40
};

function mapXMc4(x, w) {
    return GRAFIK_MC4.padding + ((x - GRAFIK_MC4.xMin) / (GRAFIK_MC4.xMax - GRAFIK_MC4.xMin)) * (w - 2 * GRAFIK_MC4.padding);
}

function mapYMc4(y, h) {
    return h - GRAFIK_MC4.padding - ((y - GRAFIK_MC4.yMin) / (GRAFIK_MC4.yMax - GRAFIK_MC4.yMin)) * (h - 2 * GRAFIK_MC4.padding);
}

function invMapXMc4(px, w) {
    return GRAFIK_MC4.xMin + ((px - GRAFIK_MC4.padding) / (w - 2 * GRAFIK_MC4.padding)) * (GRAFIK_MC4.xMax - GRAFIK_MC4.xMin);
}

function invMapYMc4(py, h) {
    return GRAFIK_MC4.yMin + ((h - GRAFIK_MC4.padding - py) / (h - 2 * GRAFIK_MC4.padding)) * (GRAFIK_MC4.yMax - GRAFIK_MC4.yMin);
}

function fungsiMc4(x) {
    return Math.pow(x, 4) - 3 * Math.pow(x, 3) - 8 * Math.pow(x, 2) + 12 * x + 16;
}

function initGrafikMc4() {
    const container = document.getElementById('grafik-mc4');
    if (!container) return;

    if (grafikMc4P5) {
        grafikMc4P5.remove();
        grafikMc4P5 = null;
    }

    titikMc4 = [];
    tampilKurvaMc4 = false;
    container.innerHTML = '';

    grafikMc4P5 = new p5((p) => {
        p.setup = function () {
            const w = Math.max(container.clientWidth || 700, 700);
            const h = 420;
            const canvas = p.createCanvas(w, h);
            canvas.parent('grafik-mc4');
        };

        p.windowResized = function () {
            const w = Math.max(container.clientWidth || 700, 700);
            p.resizeCanvas(w, 420);
        };

        p.draw = function () {
            p.background(255);

            gambarGridMc4(p);
            gambarSumbuMc4(p);
            gambarLabelMc4(p);

            if (tampilKurvaMc4) {
                gambarKurvaFungsiAsliMc4(p);
            }

            if (titikMc4.length > 0) {
                gambarTitikMc4(p);
            }

            if (titikMc4.length >= 2) {
                gambarKurvaHalusMc4(p);
            }
        };

        p.mousePressed = function () {
            if (!window.soal3GrafikAktif) return;
            if (p.mouseX < GRAFIK_MC4.padding || p.mouseX > p.width - GRAFIK_MC4.padding) return;
            if (p.mouseY < GRAFIK_MC4.padding || p.mouseY > p.height - GRAFIK_MC4.padding) return;

            const x = invMapXMc4(p.mouseX, p.width);
            const y = invMapYMc4(p.mouseY, p.height);

            titikMc4.push({
                x: Number(x.toFixed(2)),
                y: Number(y.toFixed(2))
            });

            titikMc4.sort((a, b) => a.x - b.x);
        };
    });
}

function gambarGridMc4(p) {
    p.stroke(230);
    p.strokeWeight(1);

    for (let x = Math.ceil(GRAFIK_MC4.xMin); x <= Math.floor(GRAFIK_MC4.xMax); x++) {
        const px = mapXMc4(x, p.width);
        p.line(px, GRAFIK_MC4.padding, px, p.height - GRAFIK_MC4.padding);
    }

    for (let y = Math.ceil(GRAFIK_MC4.yMin); y <= Math.floor(GRAFIK_MC4.yMax); y++) {
        const py = mapYMc4(y, p.height);
        p.line(GRAFIK_MC4.padding, py, p.width - GRAFIK_MC4.padding, py);
    }
}

function gambarSumbuMc4(p) {
    p.stroke(80);
    p.strokeWeight(2);

    const xAxisY = mapYMc4(0, p.height);
    const yAxisX = mapXMc4(0, p.width);

    p.line(GRAFIK_MC4.padding, xAxisY, p.width - GRAFIK_MC4.padding, xAxisY);
    p.line(yAxisX, GRAFIK_MC4.padding, yAxisX, p.height - GRAFIK_MC4.padding);
}

function gambarLabelMc4(p) {
    p.noStroke();
    p.fill(70);
    p.textSize(12);
    p.textAlign(p.CENTER, p.TOP);

    for (let x = Math.ceil(GRAFIK_MC4.xMin); x <= Math.floor(GRAFIK_MC4.xMax); x++) {
        const px = mapXMc4(x, p.width);
        const py = mapYMc4(0, p.height);
        p.text(String(x), px, py + 6);
    }

    p.textAlign(p.RIGHT, p.CENTER);
    for (let y = Math.ceil(GRAFIK_MC4.yMin); y <= Math.floor(GRAFIK_MC4.yMax); y++) {
        if (y === 0) continue;
        const px = mapXMc4(0, p.width);
        const py = mapYMc4(y, p.height);
        p.text(String(y), px - 6, py);
    }

    p.fill(45);
    p.textAlign(p.LEFT, p.TOP);
    p.text('x', p.width - GRAFIK_MC4.padding + 10, mapYMc4(0, p.height) - 18);
    p.text('y', mapXMc4(0, p.width) + 10, GRAFIK_MC4.padding - 18);
}

function gambarTitikMc4(p) {
    p.stroke(30, 136, 229);
    p.strokeWeight(2);
    p.fill(30, 136, 229);

    for (const t of titikMc4) {
        const px = mapXMc4(t.x, p.width);
        const py = mapYMc4(t.y, p.height);
        p.circle(px, py, 10);
    }
}

function gambarKurvaHalusMc4(p) {
    if (titikMc4.length < 2) return;

    p.noFill();
    p.stroke(220, 20, 60);
    p.strokeWeight(2.5);
    p.beginShape();

    const first = titikMc4[0];
    const last = titikMc4[titikMc4.length - 1];

    p.curveVertex(mapXMc4(first.x, p.width), mapYMc4(first.y, p.height));

    for (const t of titikMc4) {
        const px = mapXMc4(t.x, p.width);
        const py = mapYMc4(t.y, p.height);
        p.curveVertex(px, py);
    }

    p.curveVertex(mapXMc4(last.x, p.width), mapYMc4(last.y, p.height));
    p.endShape();
}

function gambarKurvaFungsiAsliMc4(p) {
    p.noFill();
    p.stroke(34, 139, 34);
    p.strokeWeight(2.5);
    p.beginShape();

    let adaTitik = false;

    for (let x = GRAFIK_MC4.xMin; x <= GRAFIK_MC4.xMax; x += 0.02) {
        const y = fungsiMc4(x);

        if (y < GRAFIK_MC4.yMin - 20 || y > GRAFIK_MC4.yMax + 20) {
            continue;
        }

        const px = mapXMc4(x, p.width);
        const py = mapYMc4(y, p.height);
        p.vertex(px, py);
        adaTitik = true;
    }

    if (adaTitik) {
        p.endShape();
    } else {
        p.endShape();
    }
}

function resetGrafikMc4() {
    titikMc4 = [];
    tampilKurvaMc4 = false;

    if (!window.soal3GrafikAktif) return;
    initGrafikMc4();
}

function gambarKurvaMc4() {
    tampilKurvaMc4 = true;
}

window.initGrafikMc4 = initGrafikMc4;
window.resetGrafikMc4 = resetGrafikMc4;
window.gambarKurvaMc4 = gambarKurvaMc4;