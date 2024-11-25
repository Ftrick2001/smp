import numpy as np
from scipy import stats

# Datos de velocidad de despliegue antes (Pretest) y después (Postest)
pretest = np.array([50, 48, 52, 45, 47, 49])
postest = np.array([30, 28, 32, 29, 31, 27])

# Prueba t de Student para muestras independientes
t_stat, p_value_t = stats.ttest_ind(pretest, postest)

print(f"Prueba t: estadístico t={t_stat:.4f}, p-value={p_value_t:.4f}")
